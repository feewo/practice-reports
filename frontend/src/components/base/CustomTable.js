import classNames from "classnames";
import { STATUSES } from "../../constants/copyright";
import CustomButton from "./CustomButton";

export default function CustomTable({head, body, title, className, onDownload, onClickName}) {
    const getTextByStatusId = (statusId) => {
        return STATUSES[Object.keys(STATUSES).find(key => STATUSES[key].id === statusId)].text
    }

    const getColorByStatusId = (statusId) => {
        return STATUSES[Object.keys(STATUSES).find(key => STATUSES[key].id === statusId)].color
    }

    const getContentByCell = (key, value, row) => {
        if (key === "statusId") {
            return getTextByStatusId(value)
        } 
        if (key === "file") {
            return <CustomButton onClick={() => onDownload?.(value, row.name)} className={"custom-table__download"} text={"Скачать"} />
        }

        return value
    }
    
    return (
        <table className={classNames("custom-table", className)}>
            {title && <caption className="custom-table__caption">{title}</caption>}

            <thead className="custom-table__head">
                <tr>
                    {head.map((item, i) => <th key={i} scope="col">{item?.title}</th>)}
                </tr>
            </thead>

            <tbody className="custom-table__body">
                {body.map((row, i) =>
                    <tr key={i}>
                        {Object.entries(row).map(([key, value], j) =>
                            key !== "id" ?
                            <td key={key} className={classNames(`custom-table__body-${key}`, {
                                [`custom-table__body-cell_${key === "statusId" && getColorByStatusId(value)}`]: key === "statusId"
                            })} onClick={key === "name" && !!onClickName && onClickName}>
                                {value ? getContentByCell(key, value, row) : "—"}
                            </td> : null
                        )}
                    </tr>
                )}
            </tbody>
        </table>
    )
}