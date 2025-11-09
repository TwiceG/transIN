import { useEffect, useState } from 'react';
import axios from 'axios';
import CryptoJS from "crypto-js";

const JobList = (props) => {
    const [jobs, setJobs] = useState([]);
    const [deliveryStatus, setDeliveryStatus] = useState('');


    const decryptToken = () => {
        const secretKey = import.meta.env.VITE_SECRET_KEY;
        const encryptedToken = localStorage.getItem('token');
        const decryptedToken = CryptoJS.AES.decrypt(encryptedToken, secretKey).toString(CryptoJS.enc.Utf8);
        return decryptedToken;
    };


    const saveJob = async (jobId) => {
        let token = localStorage.getItem('token');
        const decryptedToken = decryptToken(token);
        console.log(deliveryStatus);

        try {
            const response = await axios.patch('/update-delivery-status',
                {
                    jobId: jobId,
                    deliveryStatus: deliveryStatus,
                },
                {
                    headers: {
                        Authorization: `Bearer ${decryptedToken}`,
                    },
                }
            );
            console.log('Job updated successfully:', response.data.message);


            // Update local state for that specific job
            setJobs((prevJobs) =>
                prevJobs.map((job) =>
                    job.id === jobId ? { ...job, status: deliveryStatus } : job
                )
            );
        } catch (error) {
            console.error('Could not update delivery job:', error);
        }
    }

    const fetchJobs = async () => {
        let token = localStorage.getItem('token');
        const decryptedToken = decryptToken(token);

        try {
            const response = await axios.get(`/${props.fetchUrl}`, {
                headers: {
                    'Authorization': `Bearer ${decryptedToken}`
                }
            });
            console.log('Jobs fetched successfully:', response.data.message);

            setJobs(response.data)

        } catch (error) {
            console.error('Could not fetch the delivery jobs. ', error);

        }
    }

    useEffect(() => {
        fetchJobs();
        console.log(jobs);
    }, []);


    return (
        <div>
            <h2>Delivery Jobs</h2>
            <ul>
                {jobs.map((job) => (
                    <li key={job.id}>
                        <p>Starting address: {job.starting_address}</p>
                        <p>Destination address: {job.destination_address}</p>
                        <p>Recipient name: {job.recipient_name}</p>
                        <p>Recipient phone: {job.recipient_phone}</p>
                        <p>Status: {job.status}</p>

                        {/* Dropdown to select a new status */}
                        <select
                            value={deliveryStatus}
                            onChange={(e) => setDeliveryStatus(e.target.value)}
                        >
                            <option value="">Select status</option>
                            <option value="in_transit">In Transit</option>
                            <option value="delivered">Delivered</option>
                            <option value="failed">Failed</option>
                        </select>

                        {/* Save button */}
                        <button onClick={() => saveJob(job.id)}>Save status</button>
                    </li>
                ))}
            </ul>
        </div>
    )
}

export default JobList