import { Routes, Route } from "react-router-dom";
import Home from "./Home";
import Login from "./Login";
import Logout from "./Logout";
import DriverJobList from "./DriverJobList";
import DeliveryJobs from "./DeliveryJobs";



function AppRouter() {
    return (
        <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/login" element={<Login />} />
            <Route path="/logout" element={<Logout />} />
            <Route path="/driver-jobs" element={<DriverJobList />} />
            <Route path="/delivery-jobs" element={<DeliveryJobs />} />
        </Routes>
    );
}

export default AppRouter;