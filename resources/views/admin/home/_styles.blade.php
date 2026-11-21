<style>
    :root {
        --bg: #f1f2f4;
        --surface: #ffffff;
        --border: #e3e5e8;
        --text-primary: #202223;
        --text-secondary: #6d7175;
        --text-hint: #8c9196;
        --accent: #303d89;
        --accent-light: #f0f1fc;
        --green: #007a5e;
        --green-bg: #e3f1ec;
        --red: #b22222;
        --red-bg: #fce8e8;
        --radius-sm: 8px;
        --radius-md: 12px;
        --shadow-card: 0 1px 3px rgba(0, 0, 0, .08), 0 0 0 1px var(--border);
        --font: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }

    .list-page,
    .form-page {
        background: var(--bg);
        padding: 24px 28px;
        min-height: 100vh;
        font-family: var(--font);
        color: var(--text-primary);
    }

    .list-page *,
    .form-page * {
        box-sizing: border-box;
    }

    .list-page-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 20px;
    }

    .list-page h1,
    .form-page h1 {
        font-size: 20px;
        font-weight: 650;
        margin: 0;
    }

    .crumb {
        font-size: 12.5px;
        color: var(--text-hint);
        margin: 3px 0 20px;
    }

    .list-page-header .crumb {
        margin-bottom: 0;
    }

    .crumb a {
        color: var(--accent);
        text-decoration: none;
    }

    .crumb span {
        margin: 0 5px;
    }

    .btn-primary-dash {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: var(--accent);
        color: #fff !important;
        border: none;
        border-radius: var(--radius-sm);
        padding: 9px 18px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none !important;
        font-family: var(--font);
        white-space: nowrap;
    }

    .btn-primary-dash:hover {
        background: #252f70;
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        background: #fff;
        color: var(--text-primary) !important;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 9px 18px;
        font-size: 13px;
        text-decoration: none !important;
        margin-left: 8px;
    }

    .flash-ok {
        background: var(--green-bg);
        color: var(--green);
        border-radius: var(--radius-sm);
        padding: 10px 16px;
        font-size: 13px;
        margin-bottom: 16px;
    }

    .list-card,
    .form-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-card);
    }

    .list-card {
        overflow: hidden;
    }

    .form-card {
        padding: 24px;
        max-width: 860px;
        margin-bottom: 16px;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead tr {
        background: #fafafa;
        border-bottom: 1px solid var(--border);
    }

    .data-table thead th {
        padding: 10px 16px;
        font-size: 11px;
        font-weight: 650;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: var(--text-secondary);
        text-align: left;
        white-space: nowrap;
    }

    .data-table tbody tr {
        border-bottom: 1px solid var(--border);
    }

    .data-table tbody tr:last-child {
        border-bottom: none;
    }

    .data-table td {
        padding: 13px 16px;
        font-size: 13px;
        vertical-align: middle;
    }

    .id-chip {
        display: inline-block;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 6px;
        padding: 2px 8px;
        font-size: 11.5px;
        color: var(--text-secondary);
    }

    .row-thumb {
        width: 90px;
        height: 60px;
        border-radius: var(--radius-sm);
        object-fit: cover;
        border: 1px solid var(--border);
        display: block;
    }

    .row-icon {
        width: 40px;
        height: 40px;
        border-radius: var(--radius-sm);
        background: var(--accent-light);
        color: var(--accent);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .row-title {
        font-size: 13.5px;
        font-weight: 600;
    }

    .row-sub {
        font-size: 11.5px;
        color: var(--text-hint);
        margin-top: 3px;
    }

    .pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 600;
    }

    .pill::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
    }

    .pill-active {
        background: var(--green-bg);
        color: var(--green);
    }

    .pill-active::before {
        background: var(--green);
    }

    .pill-inactive {
        background: var(--red-bg);
        color: var(--red);
    }

    .pill-inactive::before {
        background: var(--red);
    }

    .pill-scheduled {
        background: #fff5cc;
        color: #916a00;
    }

    .pill-scheduled::before {
        background: #916a00;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border);
        background: var(--surface);
        color: var(--text-secondary);
        cursor: pointer;
        text-decoration: none;
        font-size: 12px;
    }

    .action-btn.edit:hover {
        background: var(--accent-light);
        color: var(--accent);
    }

    .action-btn.danger:hover {
        background: var(--red-bg);
        color: var(--red);
    }

    .empty-state {
        text-align: center;
        padding: 56px 24px;
    }

    .empty-state h6 {
        font-size: 14px;
        font-weight: 650;
        margin: 0 0 6px;
    }

    .empty-state p {
        font-size: 13px;
        color: var(--text-hint);
        margin: 0 0 20px;
    }

    .f-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .f-group {
        margin-bottom: 16px;
    }

    .f-group.full {
        grid-column: 1 / -1;
    }

    .f-group label {
        display: block;
        font-size: 12.5px;
        font-weight: 600;
        margin-bottom: 6px;
    }

    .f-group label small {
        font-weight: 400;
        color: var(--text-hint);
    }

    .f-control {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        padding: 9px 12px;
        font-size: 13px;
        font-family: var(--font);
        background: #fff;
        color: var(--text-primary);
    }

    .f-control:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px var(--accent-light);
    }

    textarea.f-control {
        min-height: 90px;
        resize: vertical;
    }

    .f-error {
        color: var(--red);
        font-size: 12px;
        margin-top: 4px;
    }

    .img-now {
        margin-top: 10px;
        max-width: 240px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border);
        display: block;
    }

    .f-switch {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
    }

    @media(max-width:768px) {

        .list-page,
        .form-page {
            padding: 16px;
        }

        .f-row {
            grid-template-columns: 1fr;
        }
    }
</style>