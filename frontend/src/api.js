import { getToken } from "./utils/auth";

export const apiFetch = async (endpoint, options = {}) => {
	const token = getToken();

	const headers = {
		"Content-Type": "application/json",
		...options.headers,
	};

	if (token) {
		headers.Authorization = `Bearer ${token}`;
	}

	const res = await fetch(process.env.REACT_APP_API_URL + "/api" + endpoint, {
		...options,
		headers,
	});

	if (!res.ok) {
		throw new Error(`HTTP error! status: ${res.status}`);
	}

	return res.json();
};
