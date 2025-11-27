import { useState } from "react";
import CustomButton from "../base/CustomButton";
import CustomInput from "../base/CustomInput";

export default function IntroForm({ inputs, button, onSubmit, error }) {
	const isError = error; //TO-DO: тут флаг ошибки

	const initialValues = {};
	inputs.forEach(input => {
		initialValues[input.id] = "";
	});

	const [formValues, setFormValues] = useState(initialValues);

	const handleChange = (fieldId, value) => {
		setFormValues(prev => {
			return {
				...prev,
				[fieldId]: value,
			};
		});
	};

	const handleSubmit = e => {
		e.preventDefault();
		onSubmit(formValues);
	};

	return (
		<form className="intro__form">
			{inputs.map((item, i) => (
				<div key={i} className="intro__form-item">
					<label className="intro__label" htmlFor={item.id}>
						{item.label}
					</label>
					<CustomInput
						{...item}
						value={formValues[item.id]}
						onChange={value => handleChange(item.id, value)}
						className={isError && "custom-input_error"}
					/>
				</div>
			))}

			<CustomButton onClick={handleSubmit} {...button} />
		</form>
	);
}
