import CustomTable from "../base/CustomTable";
import CustomFileInput from "../base/CustomFileInput";

export default function Student({table, file}) {
	return (
		<section className="student">
			<div className="student__block">
				<CustomFileInput className={"custom-file-input_student"} {...file} />
				<CustomTable className={"student__table"} {...table} />
			</div>
		</section>
	);
}
