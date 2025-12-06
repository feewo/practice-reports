import classNames from "classnames"
import CustomInput from "../base/CustomInput";
import CustomButton from "./CustomButton";

export default function CustomFileInput({className, title, form}) {
    return (
        <section className={classNames("custom-file-input", className)}>
            { title && <h2 className="custom-file-input__title">{title}</h2> }
            { form && 
                <form className="custom-file-input__form">
                    {form?.inputs?.map((input, i) =>
                        <CustomInput key={i} {...input} />
                    )}
                    {form?.button &&
                        <CustomButton {...form.button} />
                    }
                </form>
            }
        </section>
    )
}