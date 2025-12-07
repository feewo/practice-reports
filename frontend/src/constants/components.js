import IntroWithAuth from "../components/intro/IntroWithAuth";
import { tacherContent, studentContent } from "./copyright";
import TeacherWithData from '../components/teacher/TeacherWithData'
import StudentWithData from '../components/student/StudentWithData'

export const components = {
	intro: ({ setPage }) => <IntroWithAuth setPage={setPage} />,
	teacher: () => <TeacherWithData {...tacherContent} />,
	student: () => <StudentWithData {...studentContent} />,
};
