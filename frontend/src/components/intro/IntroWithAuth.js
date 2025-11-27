import { useState } from "react";
import Intro from "./Intro";
import { introContent } from "../../constants/copyright";
import { apiFetch } from "../../api";
import { useAuth } from "../../context/AuthContext";

export default function IntroWithAuth({ setPage }) {
	const { login } = useAuth();
	const [error, setError] = useState(false);

	const handleSubmit = async formData => {
		setError(false);

		try {
			const data = await apiFetch("/login", {
				method: "POST",
				body: JSON.stringify({
					login: formData.login,
					password: formData.password,
				}),
			});

			if (data.token) {
				login(data.token);

				const role = data.user.role || "student";

				setPage(role === "teacher" ? "teacher" : "student");
			} else {
				throw new Error("Токен не получен");
			}
		} catch (err) {
			console.error("Ошибка авторизации:", err);
			setError(true);
		}
	};

	const formWithHandlers = {
		...introContent.form,
		onSubmit: handleSubmit,
		error: error,
	};

	return <Intro {...introContent} form={formWithHandlers} />;
}
