import { useState } from "react";
import axios from 'axios';
import CryptoJS from "crypto-js";



const LoginForm = () => {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");


    const encryptAuthToken = (token) => {
        const secretKey = import.meta.env.VITE_SECRET_KEY;
        const encryptedToken = CryptoJS.AES.encrypt(token, secretKey).toString();

        return encryptedToken;
    };

    const storeUserData = (userId, userName, role, encryptedToken) => {
        localStorage.setItem('id', userId);
        localStorage.setItem('name', userName);
        localStorage.setItem('role', role);
        localStorage.setItem('token', encryptedToken);
    }



    const handleLogin = async (e) => {
        e.preventDefault();
        try {
            const response = await axios.post('/login', {
                email: email,
                password: password,
            });
            console.log('Login successful', response.data.message);

            const userId = response.data.user.id;
            const userName = response.data.user.name;
            const userRole = response.data.user.role;
            let token = response.data.token;
            const encryptedToken = encryptAuthToken(token);

            storeUserData(userId, userName, userRole, encryptedToken);
            window.location.href = "/";

        } catch (error) {
            console.error('Login error:', error);

        }
    };



    return (
        <div className="login-form-container">
            <form onSubmit={handleLogin}>
                <h2>Login</h2>

                <label>Email</label>
                <input
                    type="email"
                    placeholder="Enter your email"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    required
                />

                <label>Password</label>
                <input
                    type="password"
                    placeholder="Enter your password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                />

                <button type="submit">
                    Login
                </button>
            </form>
        </div>
    );
};

export default LoginForm;



