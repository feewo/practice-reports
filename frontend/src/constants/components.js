import IntroWithAuth from "../components/intro/IntroWithAuth";
import { tacherContent, studentContent } from "./copyright";
import TeacherWithData from '../components/teacher/TeacherWithData'
import StudentWithData from '../components/student/StudentWithData'
import CustomModal from "../components/base/CustomModal";

export const components = {
	intro: ({ setPage }) => <IntroWithAuth setPage={setPage} />,
	teacher: ({ setModal }) => <TeacherWithData {...tacherContent} setModal={setModal} />,
	student: () => <StudentWithData {...studentContent} />,
};

export const modals = {
	assessmentModal: ({ setModal }) => <CustomModal {...assessmentModalContent} setModal={setModal} />
}
