import { useEffect, useState } from "react";
import { apiFetch } from "../../api";
import { getToken } from "../../utils/auth";
import Teacher from "./Teacher";
import { downloadFile } from "../../utils/downloadFile";

function formatDate(dateStr) {
	const [year, month, day] = dateStr.split("-");
	return `${day}.${month}.${year}`;
}

function formatDates(submitted, deadline) {
	return `${formatDate(submitted)} / ${formatDate(deadline)}`;
}

const STATUS_IDS = {
	valued: 1,
	modify: 2,
	invalued: 3,
	notCompleted: 4,
};

export default function TeacherWithData({ filters, table }) {
	const [filterValues, setFilterValues] = useState({});
	const [allReports, setAllReports] = useState([]);
	const [filteredTableBody, setFilteredTableBody] = useState([]);

	const getServerFilterIds = values => {
		const ids = {};
		filters.forEach(filter => {
			if (filter.id === "status") return;

			const value = values[filter.id];
			if (value && value !== "Все") {
				const option = filter.options.find(opt => opt.value === value);
				if (option && option.id !== 0) {
					ids[filter.id] = option.id;
				}
			}
		});
		return ids;
	};

	const applyClientFilters = (reports, statusValue) => {
		if (!statusValue || statusValue === "Все") {
			return reports;
		}

		const statusOption = filters
			.find(f => f.id === "status")
			?.options.find(opt => opt.value === statusValue);

		if (!statusOption || statusOption.id === 0) {
			return reports;
		}

		let targetStatusId;
		switch (statusOption.id) {
			case 1:
				targetStatusId = STATUS_IDS.valued;
				break;
			case 2:
				targetStatusId = STATUS_IDS.modify;
				break;
			case 3:
				targetStatusId = STATUS_IDS.invalued;
				break;
			case 4:
				targetStatusId = STATUS_IDS.notCompleted;
				break;
			default:
				return reports;
		}

		return reports.filter(row => row.statusId === targetStatusId);
	};

	const loadServerData = async (filterValuesToApply = {}) => {
		try {
			const token = getToken();
			const serverFilters = getServerFilterIds(filterValuesToApply);

			const params = new URLSearchParams();
			Object.entries(serverFilters).forEach(([key, id]) => {
				params.append(key, id);
			});

			const queryString = params.toString();
			const url = queryString
				? `/teacher/students-reports?${queryString}`
				: `/teacher/students-reports`;

			const data = await apiFetch(url, {}, token);

			const rows = data.reports.map(report => ({
				id: report.report_id,
				name: report.student_fio,
				group: report.group,
				file: report.file_url,
				statusId: report.grade ? STATUS_IDS.valued : STATUS_IDS.notCompleted,
				assessment: report.grade ?? null,
				date: formatDates(report.submitted_date.split(" ")[0], report.deadline),
			}));

			setAllReports(rows);
			setFilteredTableBody(
				applyClientFilters(rows, filterValuesToApply.status)
			);
		} catch (err) {
			console.error("Ошибка загрузки данных:", err);
			setAllReports([]);
			setFilteredTableBody([]);
		}
	};

	const handleFilterChange = (filterId, value) => {
		setFilterValues(prev => {
			const newFilters = { ...prev, [filterId]: value };

			if (filterId === "status") {
				setFilteredTableBody(applyClientFilters(allReports, value));
			} else {
				loadServerData(newFilters);
			}

			return newFilters;
		});
	};

	useEffect(() => {
		loadServerData();
	}, []);

	const filtersWithHandlers = filters.map(filter => ({
		...filter,
		value: filterValues[filter.id] || "Все",
		onChange: value => handleFilterChange(filter.id, value),
	}));

	const handleDownload = (fileUrl, studentName) => {
		const filename = `${studentName}_отчёт.pdf`;
		downloadFile(fileUrl, filename);
	};

	const tableData = {
		head: table.head,
		body: filteredTableBody,
	};

	return (
		<Teacher
			filters={filtersWithHandlers}
			table={tableData}
			onDownload={handleDownload}
		/>
	);
}
