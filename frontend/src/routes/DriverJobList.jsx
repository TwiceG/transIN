import JobList from "../components/JobList"


const DriverJobList = () => {

    const driverId = localStorage.getItem('id');
    const fetchUrl = `driver-jobs-list/${driverId}`;

    return (
        <div>
            <h3>List of jobs</h3>
            <JobList fetchUrl={fetchUrl} />
        </div>
    )
}

export default DriverJobList