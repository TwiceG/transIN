import { useEffect, useState } from 'react';
import axios from 'axios';
import CryptoJS from "crypto-js";

const AdminJobList = () => {
    const [jobs, setJobs] = useState([]);
    const [newJob, setNewJob] = useState({
        starting_address: '',
        destination_address: '',
        recipient_name: '',
        recipient_phone: '',
        status: '',
    });
    const [drivers, setDrivers] = useState([]);
    const [filterStatus, setFilterStatus] = useState(''); // new filter state

    const decryptToken = () => {
        const secretKey = import.meta.env.VITE_SECRET_KEY;
        const encryptedToken = localStorage.getItem('token');
        return CryptoJS.AES.decrypt(encryptedToken, secretKey).toString(CryptoJS.enc.Utf8);
    };

    // Fetch jobs
    const fetchJobs = async () => {
        const decryptedToken = decryptToken();
        try {
            const response = await axios.get('/delivery-jobs-list', {
                headers: { Authorization: `Bearer ${decryptedToken}` }
            });
            setJobs(response.data);
        } catch (error) {
            console.error('Could not fetch jobs:', error.response?.data || error);
        }
    };

    // Fetch drivers
    const fetchDrivers = async () => {
        const decryptedToken = decryptToken();
        try {
            const response = await axios.get('/drivers-list', {
                headers: { Authorization: `Bearer ${decryptedToken}` }
            });
            setDrivers(response.data); // assuming array of {id, name}
        } catch (error) {
            console.error('Could not fetch drivers:', error.response?.data || error);
        }
    };

    useEffect(() => {
        fetchJobs();
        fetchDrivers();
    }, []);

    // Update job
    const updateJob = async (jobId, jobData) => {
        const decryptedToken = decryptToken();
        try {
            await axios.patch(`/update-job/${jobId}`, jobData, {
                headers: { Authorization: `Bearer ${decryptedToken}` }
            });
            console.log('Job updated successfully');
            fetchJobs();
        } catch (error) {
            console.error('Could not update job:', error.response?.data || error);
        }
    };

    // Delete job
    const deleteJob = async (jobId) => {
        const decryptedToken = decryptToken();
        try {
            await axios.delete(`/delete-job/${jobId}`, {
                headers: { Authorization: `Bearer ${decryptedToken}` }
            });
            console.log('Job deleted successfully');
            setJobs(prev => prev.filter(job => job.id !== jobId));
        } catch (error) {
            console.error('Could not delete job:', error.response?.data || error);
        }
    };

    // Create new job
    const createJob = async () => {
        const decryptedToken = decryptToken();
        try {
            await axios.post('/create-job', newJob, {
                headers: { Authorization: `Bearer ${decryptedToken}` }
            });
            console.log('Job created successfully');
            setNewJob({
                starting_address: '',
                destination_address: '',
                recipient_name: '',
                recipient_phone: '',
                status: '',
            });
            fetchJobs();
        } catch (error) {
            console.error('Could not create job:', error.response?.data || error);
        }
    };

    // Assign driver
    const assignDriver = async (jobId, driverId) => {
        const decryptedToken = decryptToken();
        try {
            await axios.patch('/assign-driver', { jobId, driverId }, {
                headers: { Authorization: `Bearer ${decryptedToken}` }
            });
            console.log('Driver assigned successfully');
            fetchJobs();
        } catch (error) {
            console.error('Could not assign driver:', error.response?.data || error);
        }
    };

    // Update field in job state
    const updateJobField = (jobId, field, value) => {
        setJobs(prevJobs =>
            prevJobs.map(job =>
                job.id === jobId ? { ...job, [field]: value } : job
            )
        );
    };

    // Filtered jobs based on status
    const filteredJobs = filterStatus
        ? jobs.filter(job => job.status === filterStatus)
        : jobs;

    return (
        <div>
            <h2>Admin Job List</h2>

            {/* Filter */}
            <div style={{ marginBottom: '20px' }}>
                <label>
                    Filter by status:&nbsp;
                    <select value={filterStatus} onChange={e => setFilterStatus(e.target.value)}>
                        <option value="">All</option>
                        <option value="accepted">Accepted</option>
                        <option value="distributed">Distributed</option>
                        <option value="in_transit">In Transit</option>
                        <option value="delivered">Delivered</option>
                        <option value="failed">Failed</option>
                    </select>
                </label>
            </div>

            {/* Create Job Form */}
            <div style={{ border: '1px solid #ccc', padding: '10px', marginBottom: '20px' }}>
                <h3>Create New Job</h3>
                <input
                    placeholder="Starting address"
                    value={newJob.starting_address}
                    onChange={e => setNewJob(prev => ({ ...prev, starting_address: e.target.value }))}
                />
                <input
                    placeholder="Destination address"
                    value={newJob.destination_address}
                    onChange={e => setNewJob(prev => ({ ...prev, destination_address: e.target.value }))}
                />
                <input
                    placeholder="Recipient name"
                    value={newJob.recipient_name}
                    onChange={e => setNewJob(prev => ({ ...prev, recipient_name: e.target.value }))}
                />
                <input
                    placeholder="Recipient phone"
                    value={newJob.recipient_phone}
                    onChange={e => setNewJob(prev => ({ ...prev, recipient_phone: e.target.value }))}
                />
                <select
                    value={newJob.status}
                    onChange={e => setNewJob(prev => ({ ...prev, status: e.target.value }))}
                >
                    <option value="">Select status</option>
                    <option value="accepted">Accepted</option>
                    <option value="distributed">Distributed</option>
                    <option value="in_transit">In Transit</option>
                    <option value="delivered">Delivered</option>
                    <option value="failed">Failed</option>
                </select>
                <button onClick={createJob}>Create Job</button>
            </div>

            {/* Existing Jobs */}
            <ul>
                {filteredJobs.map(job => {
                    const assignedDriver = job.user_id === 1
                        ? 'Unassigned'
                        : drivers.find(driver => driver.id === job.user_id)?.name || 'Unassigned';

                    return (
                        <li key={job.id} style={{ marginBottom: '20px', borderBottom: '1px solid #ccc', paddingBottom: '10px' }}>
                            <input
                                value={job.starting_address}
                                onChange={e => updateJobField(job.id, 'starting_address', e.target.value)}
                            />
                            <input
                                value={job.destination_address}
                                onChange={e => updateJobField(job.id, 'destination_address', e.target.value)}
                            />
                            <input
                                value={job.recipient_name}
                                onChange={e => updateJobField(job.id, 'recipient_name', e.target.value)}
                            />
                            <input
                                value={job.recipient_phone}
                                onChange={e => updateJobField(job.id, 'recipient_phone', e.target.value)}
                            />

                            {/* Status */}
                            <p>
                                <strong>Status:</strong> {job.status}
                                &nbsp;|&nbsp; <strong>Assigned to:</strong> {assignedDriver}
                            </p>

                            <select
                                value={job.status}
                                onChange={e => updateJobField(job.id, 'status', e.target.value)}
                            >
                                <option value="">Select status</option>
                                <option value="accepted">Accepted</option>
                                <option value="distributed">Distributed</option>
                                <option value="in_transit">In Transit</option>
                                <option value="delivered">Delivered</option>
                                <option value="failed">Failed</option>
                            </select>

                            {/* Assign driver */}
                            <select
                                value={job.user_id === 1 ? '' : job.user_id}
                                onChange={e => assignDriver(job.id, e.target.value)}
                            >
                                <option value="">Assign Driver</option>
                                {drivers.map(driver => (
                                    <option key={driver.id} value={driver.id}>{driver.name}</option>
                                ))}
                            </select>

                            <div>
                                <button onClick={() => updateJob(job.id, job)}>Update</button>
                                <button onClick={() => deleteJob(job.id)}>Delete</button>
                            </div>
                        </li>
                    )
                })}
            </ul>

        </div>
    );
};

export default AdminJobList;
