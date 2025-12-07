import { getToken } from "./auth";

export const uploadReport = async (file, internshipId) => {
	if (!file || !internshipId) {
		throw new Error("Файл и internship_id обязательны");
	}

	const token = getToken();
	const formData = new FormData();
	formData.append("internship_id", internshipId);
	formData.append("file", file);

	const response = await fetch(
		`${process.env.REACT_APP_API_URL}/api/reports/upload`,
		{
			method: "POST",
			headers: {
				Authorization: `Bearer ${token}`,
			},
			body: formData,
		}
	);

	if (!response.ok) {
		const errorText = await response.text().catch(() => "Неизвестная ошибка");
		throw new Error(`Ошибка загрузки: ${response.status} ${errorText}`);
	}
};
