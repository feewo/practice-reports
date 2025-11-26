export default function CustomInput ({id, type, label, placeholder, className}) {
    return (
        <input className={`custom-input ${className}`} {...{id, type, label, placeholder}} />
    )
}