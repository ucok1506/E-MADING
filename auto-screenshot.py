import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
import os

# Setup Chrome options
chrome_options = Options()
chrome_options.add_argument("--window-size=1920,1080")

# Create screenshots directory
os.makedirs("screenshots", exist_ok=True)

# Initialize driver
driver = webdriver.Chrome(options=chrome_options)

try:
    # 1. Home page
    driver.get("http://localhost:8000")
    time.sleep(3)
    driver.save_screenshot("screenshots/home-page.png")
    print("✓ home-page.png")

    # 2. Login page
    driver.get("http://localhost:8000/login")
    time.sleep(2)
    driver.save_screenshot("screenshots/login-page.png")
    print("✓ login-page.png")

    # 3. Login process
    driver.find_element(By.NAME, "username").send_keys("admin@smk.sch.id")
    driver.find_element(By.NAME, "password").send_keys("admin123")
    driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()
    time.sleep(3)

    # 4. Dashboard
    driver.get("http://localhost:8000/dashboard")
    time.sleep(3)
    driver.save_screenshot("screenshots/dashboard.png")
    print("✓ dashboard.png")

    # 5. Create article
    driver.get("http://localhost:8000/mading/create")
    time.sleep(2)
    driver.save_screenshot("screenshots/create-article.png")
    print("✓ create-article.png")

    # 6. Manage articles
    driver.get("http://localhost:8000/mading")
    time.sleep(2)
    driver.save_screenshot("screenshots/manage-articles.png")
    print("✓ manage-articles.png")

    # 7. Search feature (back to home with search)
    driver.get("http://localhost:8000")
    time.sleep(2)
    driver.save_screenshot("screenshots/search-feature.png")
    print("✓ search-feature.png")

    # 8. Like system (same as home)
    driver.save_screenshot("screenshots/like-system.png")
    print("✓ like-system.png")

    # 9. Notifications (dashboard with notification)
    driver.get("http://localhost:8000/dashboard")
    time.sleep(2)
    driver.save_screenshot("screenshots/notifications.png")
    print("✓ notifications.png")

    print("\n✅ Semua screenshot berhasil diambil!")

except Exception as e:
    print(f"❌ Error: {e}")

finally:
    driver.quit()