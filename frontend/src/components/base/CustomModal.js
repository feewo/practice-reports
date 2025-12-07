import CustomButton from "./CustomButton";
import Close from "../icons/Close";
import CustomInput from "./CustomInput";

export default function CustomModal({title, params, inputs, buttons, setModal}) {
    const onCloseModal = () => {
        setModal("");
    }
    
    return (
        <div className="custom-modal">
            <form className="custom-modal__content">
                <div className="custom-modal__head">
                    <h2 className="custom-modal__title">{title}</h2>
                    <CustomButton className="custom-button_icon" Icon={Close} onClick={onCloseModal} />
                </div>

                <div className="custom-modal__body">
                    {params &&
                        <div className="custom-modal__params">
                            {params.map((param, i) =>
                                <p key={i} className="custom-modal__param">
                                    <span className="custom-modal__param-title">{param.title}</span>
                                    {param.value}
                                </p>
                            )}
                        </div>
                    }

                    {inputs &&
                        <div className="custom-modal__inputs">
                            {inputs.map((input, i) =>
                                <CustomInput key={i} {...input} />
                            )}
                        </div>
                    }
                </div>

                <div className="custom-modal__footer">
                    {buttons.map((button, i) =>
                        <CustomButton key={i} {...button} onClick={onCloseModal} />
                    )}
                </div>
            </form>
        </div>
    )
}