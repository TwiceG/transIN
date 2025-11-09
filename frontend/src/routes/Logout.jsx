
import { useEffect } from "react";
import CryptoJS from "crypto-js";
import axios from 'axios';


const Logout = () => {

    const decryptToken = () => {
        const secretKey = import.meta.env.VITE_SECRET_KEY;
        const encryptedToken = localStorage.getItem('token');
        const decryptedToken = CryptoJS.AES.decrypt(encryptedToken, secretKey).toString(CryptoJS.enc.Utf8);
        return decryptedToken;
    };

    const clearUserData = () => {
        localStorage.removeItem('id');
        localStorage.removeItem('name');
        localStorage.removeItem('token');
        localStorage.removeItem('role');
    };

    const logoutUser = async () => {
        const token = decryptToken();

        try {
            await axios.post('/logout', {}, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });
            clearUserData();
        } catch (error) {
            console.error('Error logging out:', error);
        }
    };

    useEffect(() => {
        logoutUser();
        const timer = setTimeout(() => {
            window.location.href = '/';
        }, 1500);

        return () => clearTimeout(timer);
    }, []);


    return (
        <div className="logout-container" >
            <h1>Good bye! </h1>
        </div>
    );
};


export default Logout;
