const puppeteer = require('puppeteer');
const fs = require('fs');

async function takeScreenshots() {
    const browser = await puppeteer.launch({ headless: false });
    const page = await browser.newPage();
    await page.setViewport({ width: 1920, height: 1080 });

    const screenshots = [
        { name: 'home-page.png', url: 'http://localhost:8000' },
        { name: 'login-page.png', url: 'http://localhost:8000/login' }
    ];

    for (const shot of screenshots) {
        await page.goto(shot.url);
        await page.waitForTimeout(2000);
        await page.screenshot({ 
            path: `screenshots/${shot.name}`, 
            fullPage: true 
        });
        console.log(`✓ ${shot.name} captured`);
    }

    // Login and capture authenticated pages
    await page.goto('http://localhost:8000/login');
    await page.type('input[name="username"]', 'admin@smk.sch.id');
    await page.type('input[name="password"]', 'admin123');
    await page.click('button[type="submit"]');
    await page.waitForNavigation();

    const authScreenshots = [
        { name: 'dashboard.png', url: 'http://localhost:8000/dashboard' },
        { name: 'create-article.png', url: 'http://localhost:8000/mading/create' },
        { name: 'manage-articles.png', url: 'http://localhost:8000/mading' }
    ];

    for (const shot of authScreenshots) {
        await page.goto(shot.url);
        await page.waitForTimeout(2000);
        await page.screenshot({ 
            path: `screenshots/${shot.name}`, 
            fullPage: true 
        });
        console.log(`✓ ${shot.name} captured`);
    }

    await browser.close();
}

takeScreenshots().catch(console.error);