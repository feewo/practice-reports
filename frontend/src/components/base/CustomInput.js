// Добавил управление значением
export default function CustomInput({
	id,
	type,
	label,
	placeholder,
	className,
	value,
	onChange,
}) {
	return (
		<input
			className={`custom-input ${className}`}
			onChange={e => onChange?.(e.target.value)}
			{...{ id, type, label, placeholder, value }}
		/>
	);
}
