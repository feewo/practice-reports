export default function CustomButton({ text, onClick }) {
	return (
		<button className="custom-button" onClick={onClick}>
			{text}
		</button>
	);
}
