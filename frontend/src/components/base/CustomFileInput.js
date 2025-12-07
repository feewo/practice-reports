import classNames from "classnames"
import CustomInput from "../base/CustomInput";
import CustomButton from "./CustomButton";
import { useState } from 'react'
import { INTERNSHIP_IDS } from '../../constants/copyright'

export default function CustomFileInput({className, title, form, onFileUpload}) {
    const [selectedPractice, setSelectedPractice] = useState(""); 
    const [selectedFile, setSelectedFile] = useState(null);

    const handleSubmit = (e) => {
        e.preventDefault();
        
        const internshipId = INTERNSHIP_IDS[selectedPractice];
        if (internshipId && selectedFile && onFileUpload) {
            onFileUpload(selectedFile, internshipId);
        } else {
            alert("Пожалуйста, выберите практику и файл");
        }
    };

    const handlePracticeChange = (value) => {
        setSelectedPractice(value);
    };

    const handleFileChange = (file) => {
        setSelectedFile(file);
    };

    return (
        <section className={classNames("custom-file-input", className)}>
            { title && <h2 className="custom-file-input__title">{title}</h2> }
            { form && 
                <form className="custom-file-input__form">
                    {form.inputs?.map((input, i) => {
            if (input.type === "file") {
              return (
                <CustomInput
                  key={i}
                  {...input}
                  onChange={handleFileChange}
                />
              );
            }
            if (input.options) {
              return (
                <CustomInput
                  key={i}
                  {...input}
                  onChange={handlePracticeChange}
                />
              );
            }
            return <CustomInput key={i} {...input} />;
          })}
                    {form?.button &&
                        <CustomButton {...form.button} onClick={handleSubmit} />
                    }
                </form>
            }
        </section>
    )
}