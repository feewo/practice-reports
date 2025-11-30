import CustomFilter from "../base/CustomFilter";

export default function Teacher({filters, tableHead, list}) {
	return (
		<section className="teacher">
			<div className="teacher__block">
				<div className="teacher__filters">
					{filters.map((filter, i) => <CustomFilter key={i} filter={filter} />)}
				</div>
			</div>
		</section>
	);
}
