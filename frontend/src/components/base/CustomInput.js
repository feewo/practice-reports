import classNames from "classnames"
import { useRef, useState } from "react";
import CustomButton from "./CustomButton";
import {CSSTransition} from "react-transition-group"

// Добавил управление значением
export default function CustomInput({
	id,
	type,
	label,
	placeholder,
	className,
	value,
	onChange,
	options
}) {
	const listRef = useRef(null);
	const [activeOption, setActiveOption] = useState(null);
	const [isVisible, setIsVisible] = useState(false);

	const onOptionSelect = (e, option) => {
		e.preventDefault();
    setActiveOption(option);
    setIsVisible(false);
		if (onChange) {
      onChange(option); 
    }
	}

	const onMouseOver = () => {
        setIsVisible(true);
    }
    const onMouseOut = () => {
        setIsVisible(false);
    }

	const field = (type === "textarea" ?
		<textarea className="custom-input custom-input_textarea" {...{ id, type, label, placeholder, value }} />
		:
		<input
			className={`custom-input custom-input_${type}`}
			onChange={(e) => {
      			if (type === "file") {
							onChange?.(e.target.files[0]);
						} else {
							onChange?.(e.target.value);
						}
					}}
			{...{ id, type, label, placeholder, value }}
		/>
	)
	
	return (
		<div className={classNames("custom-input__container", className)} onMouseOver={onMouseOver} onMouseOut={onMouseOut}>
			{label &&
				<label htmlFor={id} className="custom-input__label" dangerouslySetInnerHTML={{ __html: label }}></label>
			}
			{options ? 
				<CustomButton className="custom-input__value" text={activeOption || placeholder}/>
				:
				field
			}

			{options &&
				<CSSTransition 
					in={isVisible} 
					nodeRef={listRef}
					timeout={500} 
					classNames="custom-input__list"
					unmountOnExit
				>
					<ul className="custom-input__list" ref={listRef}>
						{options?.map((option, i) =>
							<li key={i} className="custom-input__option">
								<CustomButton 
									className="custom-input__option-btn" 
									onClick={(e) => onOptionSelect(e, option?.value)}
									text={option?.value} 
								/>
							</li>
						)}
					</ul>
				</CSSTransition>
			}
		</div>
		
	);
}
