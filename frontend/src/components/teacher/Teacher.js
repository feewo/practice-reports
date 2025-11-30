import CustomFilter from "../base/CustomFilter";
import CustomTable from "../base/CustomTable";

export default function Teacher({filters, table}) {
	return (
		<section className="teacher">
			<div className="teacher__block">
				<div className="teacher__filters">
					{filters.map((filter, i) => <CustomFilter key={i} filter={filter} />)}
				</div>
				<CustomTable className={"teacher__table"} {...table} />
			</div>
		</section>
	);
}
