import { Link } from "react-router-dom";
import "../style/NavBar.css";

const NavBar = () => {
    const userName = localStorage.getItem("name");
    const userRole = localStorage.getItem("role"); // 'driver' or 'admin'

    return (
        <nav>
            <div className="navbar-container">
                <div className="nav-left">
                    <Link to="/">Home</Link>
                    {userRole === "driver" && <Link to="/driver-jobs">Jobs</Link>}
                    {userRole === "admin" && <Link to="/delivery-jobs">Delivery Jobs</Link>}
                </div>

                <div className="nav-right">
                    {userName && <p>Hello {userName}!</p>}
                    {!userName && <Link to="/login">Login</Link>}
                    {userName && <Link to="/logout">Logout</Link>}
                </div>
            </div>
        </nav>
    );
};

export default NavBar;
