import IntroWithAuth from "../components/intro/IntroWithAuth";
import Student from "../components/student/Student";
import { tacherContent, studentContent, assessmentModalContent } from "./copyright";
import TeacherWithData from '../components/teacher/TeacherWithData'
import CustomModal from "../components/base/CustomModal";

export const components = {
	intro: ({ setPage }) => <IntroWithAuth setPage={setPage} />,
	teacher: ({ setModal }) => <TeacherWithData {...tacherContent} setModal={setModal} />,
	student: () => <Student {...studentContent} />,
};

export const modals = {
	assessmentModal: ({ setModal }) => <CustomModal {...assessmentModalContent} setModal={setModal} />
}
