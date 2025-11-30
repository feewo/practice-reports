import classNames from "classnames"

export default function CustomButton({ text, onClick, Icon, img, className }) {
	return (
		<button className={classNames("custom-button", className)} onClick={onClick}>
			{text}
			{img && 
				<img 
					className="custom-button__img" 
					alt={""}
					{...img}
				/>
			}
			{Icon && <Icon className={"custom-button__icon"} />}
		</button>
	);
}
