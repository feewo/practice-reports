import { modals } from "../../constants/components";
import CustomFilter from "../base/CustomFilter";
import CustomTable from "../base/CustomTable";

export default function Teacher({filters, table, onDownload, setModal}) {
	const onClickName = () => {
		setModal("assessmentModal");
	}
	
	return (
		<section className="teacher">
			<div className="teacher__block">
				<div className="teacher__filters">
					{filters.map((filter, i) => <CustomFilter key={i} filter={filter} />)}
				</div>
				<CustomTable className={"teacher__table"} {...table} onClickName={onClickName} onDownload={onDownload} />
			</div>
		</section>
	);
}
