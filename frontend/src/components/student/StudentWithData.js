import { useEffect, useState } from "react";
import Student from "./Student";
import { apiFetch } from "../../api";
import { downloadFile } from "../../utils/downloadFile";
import { uploadReport } from "../../utils/uploadReport";

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

export default function StudentWithData({ table, file }) {
	const [tableBody, setTableBody] = useState([]);

	const loadServerData = async () => {
		const getStatus = report => {
			if (report.comment && report.grade) {
				return STATUS_IDS.modify;
			}
			if (!report.comment && report.grade) {
				return STATUS_IDS.valued;
			}
			return STATUS_IDS.invalued;
		};

		try {
			const data = await apiFetch("/student/reports", {});

			const rows = data.map(report => ({
				id: report.report_id,
				practice: report.internship_title,
				director: report.teacher,
				file: report.file_url,
				statusId: getStatus(report),
				assessment: report.grade,
				comment: report.comment ?? "",
				date: formatDates(report.submitted_date.split(" ")[0], report.deadline),
			}));

			setTableBody(rows);
		} catch (err) {
			console.error("Ошибка загрузки данных:", err);
			setTableBody([]);
		}
	};

	useEffect(() => {
		loadServerData();
	}, []);

	const handleFileUpload = async (selectedFile, internshipId) => {
		try {
			await uploadReport(selectedFile, internshipId);
			await loadServerData();
		} catch (err) {
			console.error("Ошибка загрузки:", err);
			alert(err.message || "Не удалось загрузить файл");
		}
	};

	const handleDownload = (fileUrl, studentName) => {
		const filename = `${studentName}_отчёт.pdf`;
		downloadFile(fileUrl, filename);
	};

	const tableData = {
		head: table.head,
		body: tableBody,
	};

	return (
		<Student
			table={tableData}
			file={file}
			onDownload={handleDownload}
			onFileUpload={handleFileUpload}
		/>
	);
}
