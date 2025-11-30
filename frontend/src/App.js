// src/App.js
import { useState, useEffect } from "react";
import "../src/style.css";
import { components } from "./constants/components";
import { apiFetch } from "./api";
import { getToken } from "./utils/auth";
import { AuthProvider } from "./context/AuthContext";
import CustomHeader from "./components/base/CustomHeader";
import { headerContent } from "./constants/copyright";

function App() {
	const [page, setPage] = useState("checking");

	const pagesWithHeader = ["teacher", "student"];

	useEffect(() => {
		const checkAuthAndSetPage = async () => {
			const token = getToken();

			if (!token) {
				setPage("intro");
				return;
			}

			try {
				const userData = await apiFetch("/check-token", {});
				const role = userData.user.role;

				if (role === "teacher") {
					setPage("teacher");
				} else if (role === "student") {
					setPage("student");
				} else {
					throw new Error("Unknown role");
				}
			} catch (err) {
				console.warn("Сессия недействительна:", err);
				setPage("intro");
			}
		};

		checkAuthAndSetPage();
	}, []);

	if (page === "checking") {
		return <div className="App">Проверка сессии...</div>;
	}

	return (
		<AuthProvider>
			<div className="App">
				<div className="page">
					{pagesWithHeader.includes(page) && <CustomHeader {...headerContent} />}
					{components[page] ? components[page]({ setPage }) : null}
				</div>
			</div>
		</AuthProvider>
	);
}

export default App;
