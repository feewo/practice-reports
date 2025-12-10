import IntroForm from "./IntroForm";
import Logo from "../icons/Logo";

export default function Intro({title, subtitle, form, footer}) {
    return (
        <section className="intro">
            <div className="intro__content">
                <div className="intro__block">
                    <h1 className="intro__title">
                        <Logo className="intro__logo" />
                        {title}
                    </h1>
                    <p className="intro__subtitle">{subtitle}</p>

                    <IntroForm {...form} />

                    <p className="intro__footer">{footer}</p>
                </div>
            </div>
        </section>
    )
}