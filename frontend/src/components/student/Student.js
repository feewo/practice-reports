import CustomTable from "../base/CustomTable";
import CustomFileInput from "../base/CustomFileInput";

export default function Student({table, file, onDownload, onFileUpload}) {
	return (
		<section className="student">
			<div className="student__block">
				<CustomFileInput className={"custom-file-input_student"} {...file} onFileUpload={onFileUpload} />
				<CustomTable className={"student__table"} {...table} onDownload={onDownload}/>
			</div>
		</section>
	);
}
