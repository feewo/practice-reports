export const STATUSES = {
    valued: {id: 1, text: "Оценен", color: "green"},
    modify: {id: 2, text: "На доработку", color: "red"},
    invalued: {id: 3, text: "Не оценен", color: "yellow"},
    notCompleted: {id: 4, text: "Не сдано", color: "gray"},
}

export const headerContent = {
    logo: "ЯГТУ",
    name: "Петров П.П.", // Временно
}

export const introContent = {
    title: "ЯГТУ",
    subtitle: "Вход в систему",
    form: {
        inputs: [
            {
                id: "login",
                type: "text",
                label: "Логин",
                placeholder: "Введите логин"
            },
            {
                id: "password",
                type: "password",
                label: "Пароль",
                placeholder: "Введите пароль"
            }
        ],
        button: {
            text: "Войти"
        }
    },
    footer: "© 2025 ЯГТУ — сервис учёта практик",
}

export const tacherContent = {
    filters: [
        {
            id: "group_id",
            title: "Группа",
            activeOption: "Все",
            options: [
                {id: 0, value: "Все"},
                {id: 1, value: "ИТ-1"},
                {id: 2, value: "ИТ-2"},
                {id: 3, value: "ПИ-1"},
                {id: 4, value: "ПИ-2"},
            ]
        },
        {
            id: "course", 
            title: "Курс",
            activeOption: "Все",
            options: [
                {id: 0, value: "Все"},
                {id: 1, value: "1"},
                {id: 2, value: "2"},
            ]
        },
        {
            id: "status",
            title: "Статус",
            activeOption: "Все",
            options: [
                {id: 0, value: "Все"},
                {id: 1, value: STATUSES.valued.text},
                {id: 2, value: STATUSES.invalued.text},
                {id: 3, value: STATUSES.modify.text},
                {id: 4, value: STATUSES.notCompleted.text},
            ]
        },
    ],
    table: {
        head: [
            {title: "ФИО"},
            {title: "Группа"},
            {title: "Файл"},
            {title: "Статус"},
            {title: "Оценка"},
            {title: "Дата (сдача / дедлайн)"},
        ],
        body: [ // Временно
            {
                id: 1,
                name: "Иванов И.И.",
                group: "ИС-31",
                file: "test.pdf",
                statusId: 3,
                assessment: null,
                date: "12.06.2025 / 20.06.2025",
            },
            {
                id: 2,
                name: "Петров А.А.",
                group: "ИС-31",
                file: "test.pdf",
                statusId: 1,
                assessment: "зачтено",
                date: "10.06.2025 / 20.06.2025",
            },
            {
                id: 3,
                name: "Сидоров С.С.",
                group: "ИС-32",
                file: "test.pdf",
                statusId: 2,
                assessment: null,
                date: "11.06.2025 / 20.06.2025",
            },
            {
                id: 4,
                name: "Кузнецов Д.Д.",
                group: "ИС-21",
                file: null,
                statusId: 4,
                assessment: null,
                date: "— / 20.06.2025",
            }
        ]
    }
}

export const studentContent = {

}

export const assessmentModalContent = {
    
}