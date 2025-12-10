import { useAuth } from "../../context/AuthContext";
import CustomButton from "./CustomButton";
import Exit from "../icons/Exit.js";
import Logo from "../icons/Logo.js";

export default function CustomHeader({logo, name}) {
    const { logout } = useAuth();
    
    const LogoutHandler = () => {
        logout();
        window.location.reload(); // Временное решение
    };
    
    return (
        <header className="custom-header">
            <p className="custom-header__logo">
                <Logo className={"custom-header__icon"} />
                {logo}
            </p>

            <div className="custom-header__profile">
                <p className="custom-header__profile-name">{name}</p>
                <CustomButton className={"custom-header__exit"} Icon={Exit} onClick={LogoutHandler} />
            </div>
        </header>
    )
}