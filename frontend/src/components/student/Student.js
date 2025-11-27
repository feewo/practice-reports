import { useAuth } from "../../context/AuthContext";
import CustomButton from "../base/CustomButton";

export default function Student() {
	const { logout } = useAuth();

	const LogoutHandler = () => {
		logout();
		window.location.reload(); // Временное решение
	};

	// Демонстрация работы
	return (
		<>
			<h1>Студент</h1>
			<CustomButton text={"Выйти"} onClick={LogoutHandler}></CustomButton>
		</>
	);
}
