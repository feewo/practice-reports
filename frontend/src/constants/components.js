import IntroWithAuth from "../components/intro/IntroWithAuth";
import { tacherContent, studentContent, assessmentModalContent } from "./copyright";
import TeacherWithData from '../components/teacher/TeacherWithData'
import StudentWithData from '../components/student/StudentWithData'
import AssessmentModalWithData from '../components/modals/AssessmentModalWithData'

export const components = {
	intro: ({ setPage }) => <IntroWithAuth setPage={setPage} />,
	teacher: ({ setModal, setModalData }) => <TeacherWithData {...tacherContent} setModal={setModal} setModalData={setModalData} />,
	student: () => <StudentWithData {...studentContent} />,
};

export const modals = {
	assessmentModal: ({ setModal, modalData }) => <AssessmentModalWithData {...assessmentModalContent} setModal={setModal} modalData={modalData} />
}
