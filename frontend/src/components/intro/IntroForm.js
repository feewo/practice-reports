import CustomButton from "../base/CustomButton";
import CustomInput from "../base/CustomInput";

export default function IntroForm ({inputs, button}) {
    const isError = false; //TO-DO: тут флаг ошибки

    return (
        <form className="intro__form">
            {inputs.map((item, i) =>
                <div className="intro__form-item">
                    <label className="intro__label" htmlFor={item.id}>{item.label}</label>
                    <CustomInput {...item} className={isError && "custom-input_error"} />
                </div>
            )}

            <CustomButton {...button} />
        </form>
    )
}