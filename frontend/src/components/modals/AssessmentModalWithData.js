import { useState } from "react";
import { apiFetch } from "../../api";
import { getToken } from "../../utils/auth";
import CustomModal from "../base/CustomModal";
import { GRADE_TYPE_IDS } from "../../constants/copyright";

export default function AssessmentModalWithData({
	title,
	inputs,
	buttons,
	setModal,
	modalData,
}) {
	const { reportId, studentName, reportTitle, onAssessmentSuccess } =
		modalData || {};

	const [formData, setFormData] = useState({
		assessment: "",
		comment: "",
	});

	const handleInputChange = (fieldId, value) => {
		setFormData(prev => ({ ...prev, [fieldId]: value }));
	};

	const handleSubmit = async () => {
		if (!reportId) {
			console.error("Нет reportId");
			return;
		}

		if (formData.assessment === "Не зачтено" && !formData.comment.trim()) {
			alert("Комментарий обязателен при «Не зачтено»");
			return;
		}

		try {
			const token = getToken();
			await apiFetch(
				"/grades/set",
				{
					method: "POST",
					headers: { "Content-Type": "application/json" },
					body: JSON.stringify({
						report_id: reportId,
						grade_type_id: GRADE_TYPE_IDS[formData.assessment],
						comment: formData.comment,
					}),
				},
				token
			);
			setModal("");
			onAssessmentSuccess?.();
		} catch (err) {
			console.error("Ошибка оценки:", err);
			alert("Не удалось сохранить оценку");
		}
	};

	const dynamicContent = {
		title,
		inputs,
		buttons,
		params: [
			{ title: "Студент:", value: studentName || "—" },
			{ title: "Работа:", value: reportTitle || "—" },
		],
	};

	const buttonsWithHandlers = dynamicContent.buttons.map(btn => {
		if (btn.action === "submit") {
			return { ...btn, onClick: handleSubmit };
		}
		if (btn.action === "close") {
			return { ...btn, onClick: () => setModal("") };
		}
		return btn;
	});

	const inputsWithHandlers = dynamicContent.inputs.map(input => ({
		...input,
		value: formData[input.id] || "",
		onChange: value => handleInputChange(input.id, value),
	}));

	return (
		<CustomModal
			title={dynamicContent.title}
			params={dynamicContent.params}
			inputs={inputsWithHandlers}
			buttons={buttonsWithHandlers}
			setModal={setModal}
		/>
	);
}
