import IntroWithAuth from "../components/intro/IntroWithAuth";
import Student from "../components/student/Student";
import { tacherContent, studentContent } from "./copyright";
import TeacherWithData from '../components/teacher/TeacherWithData'

export const components = {
	intro: ({ setPage }) => <IntroWithAuth setPage={setPage} />,
	teacher: () => <TeacherWithData {...tacherContent} />,
	student: () => <Student {...studentContent} />,
};
