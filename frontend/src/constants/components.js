import Intro from "../components/intro/Intro";
import Teacher from "../components/teacher/Teacher"
import Student from "../components/student/Student"
import { introContent, tacherContent, studentContent } from "./copyright";

export const components = {
    intro: () => <Intro {...introContent} />,
    teacher: () =>  <Teacher {...tacherContent} />,
    student: () => <Student {...studentContent} />
}