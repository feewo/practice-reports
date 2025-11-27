import IntroWithAuth from "../components/intro/IntroWithAuth";
import Teacher from "../components/teacher/Teacher";
import Student from "../components/student/Student";
import { tacherContent, studentContent } from "./copyright";

export const components = {
	intro: ({ setPage }) => <IntroWithAuth setPage={setPage} />,
	teacher: () => <Teacher {...tacherContent} />,
	student: () => <Student {...studentContent} />,
};
