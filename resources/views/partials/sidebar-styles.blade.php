<style>
    .sl-page-container {
        max-width: 1500px;
        margin: 16px auto;
        display: grid;
        grid-template-columns: 320px minmax(0, 1fr) 350px;
        gap: 16px;
        padding: 0 12px;
        font-family: "Montserrat", Arial, sans-serif;
    }

    .sl-left-column, .sl-right-column { display: flex; flex-direction: column; gap: 16px; }

    .sl-side-card {
        background: white;
        border: 1px solid #dfe4df;
        box-shadow: 0 2px 10px rgba(0,0,0,.05);
        border-radius: 4px;
        overflow: hidden;
    }

    .sl-section-title {
        color: white;
        padding: 13px 16px;
        font-size: 17px;
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sl-section-title b { margin-left: auto; font-size: 26px; }
    .sl-section-title.green { background: linear-gradient(90deg, #247d18, #116209); }
    .sl-section-title.blue { background: linear-gradient(90deg, #1773a0, #14567b); }

    .sl-mini-article {
        display: grid;
        grid-template-columns: 105px 1fr;
        gap: 13px;
        padding: 13px;
    }

    .sl-mini-article img {
        width: 105px;
        height: 125px;
        object-fit: cover;
        border-radius: 4px;
    }

    .sl-mini-article h3 { font-size: 17px; line-height: 1.15; margin-bottom: 7px; }
    .sl-mini-article p { color: #52615b; font-size: 13px; }
    .sl-mini-article a { display: inline-block; margin-top: 9px; color: #14752d; font-weight: 800; font-size: 13px; }

    .sl-main-column { min-width: 0; }

    .sl-right-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #0c6545;
        padding: 5px 4px 10px;
        margin-bottom: 14px;
    }

    .sl-right-title h2 { font-size: 19px; margin: 0; color: #17231f; }
    .sl-right-title a { color: #0c6545; font-size: 12px; font-weight: 800; text-decoration: none; }

    .sl-right-news {
        display: grid;
        grid-template-columns: 100px 1fr;
        gap: 12px;
        padding: 11px 4px;
        border-bottom: 1px solid #e4e7e5;
        cursor: pointer;
    }

    .sl-right-news img { width: 100px; height: 72px; object-fit: cover; border-radius: 4px; }
    .sl-right-news h3 { font-size: 13px; line-height: 1.2; margin: 0; }
    .sl-right-news small { display: block; margin-top: 5px; color: #727b77; font-size: 9px; }

    .sl-latest-card { padding: 10px 12px; }

    .sl-advertising {
        background: linear-gradient(135deg, #e2f3e7, #c9e3d0);
        border-radius: 5px;
        padding: 22px;
        text-align: center;
        color: #064832;
        border: 1px solid #b4d5bf;
    }

    .sl-advertising img { max-width: 100%; border-radius: 4px; }
    .sl-advertising .sl-ad-icon { font-size: 35px; }
    .sl-advertising h2 { font-size: 18px; margin: 5px 0; }
    .sl-advertising p { font-size: 12px; margin-bottom: 14px; }
    .sl-advertising a {
        display: inline-block;
        background: #003d2b;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        font-weight: 800;
        font-size: 13px;
        text-decoration: none;
    }

    @media (max-width: 1150px) {
        .sl-page-container { grid-template-columns: 250px minmax(0, 1fr); }
        .sl-right-column { display: none; }
    }

    @media (max-width: 800px) {
        .sl-page-container { display: block; padding: 0 8px; }
        .sl-left-column, .sl-main-column { margin-bottom: 16px; }
    }
</style>
