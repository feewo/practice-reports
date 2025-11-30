import { useRef, useState } from "react";
import { CSSTransition } from "react-transition-group"
import CustomButton from "../base/CustomButton";

export default function CustomFilter({filter}) {
    const [activeOption, setActiveOption] = useState(filter?.activeOption);
    const [isVisibleList, setIsVisibleList] = useState(false);
    const listRef = useRef(null);
    console.log(isVisibleList);
    const onOptionSelect = (option) => {
        filter.onChange?.(option);
        setActiveOption(option);
        setIsVisibleList(false);
    }

    const onMouseOver = () => {
        setIsVisibleList(true);
    }
    const onMouseOut = () => {
        setIsVisibleList(false);
    }
    
    return (
        <div className="custom-filter" onMouseOver={onMouseOver} onMouseOut={onMouseOut}>
            <p className="custom-filter__name">{filter?.title}</p>
            <CustomButton className="custom-filter__value" text={activeOption}/>

            <CSSTransition 
                in={isVisibleList} 
                nodeRef={listRef}
                timeout={500} 
                classNames="custom-filter__list"
                unmountOnExit
            >
                <ul className="custom-filter__list" ref={listRef}>
                    {filter?.options?.map((option, i) =>
                        <li key={i} className="custom-filter__option">
                            <CustomButton 
                                className="custom-filter__option-btn" 
                                onClick={() => onOptionSelect(option?.value)}
                                text={option?.value} 
                            />
                        </li>
                    )}
                </ul>
            </CSSTransition>
            
        </div>
    )
}