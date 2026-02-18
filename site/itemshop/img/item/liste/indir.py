import os
import time
import requests

BASE_URL = "https://img.m2icondb.com/"
LISTE_DOSYASI = "liste.txt"
KAYIT_KLASORU = "indirilenler"

os.makedirs(KAYIT_KLASORU, exist_ok=True)

with open(LISTE_DOSYASI, "r", encoding="utf-8") as f:
    dosyalar = [line.strip() for line in f if line.strip()]

print(f"Toplam {len(dosyalar)} dosya bulundu.")

session = requests.Session()
session.headers.update({
    "User-Agent": "Mozilla/5.0"
})

indirilen = 0
bulunamayan = 0

for i, dosya_adi in enumerate(dosyalar, start=1):
    url = BASE_URL + dosya_adi
    hedef_yol = os.path.join(KAYIT_KLASORU, dosya_adi)

    # daha önce indirilmişse geç
    if os.path.exists(hedef_yol):
        print(f"[{i}/{len(dosyalar)}] Zaten var: {dosya_adi}")
        continue

    try:
        r = session.get(url, timeout=15)

        if r.status_code == 200 and r.headers.get("Content-Type", "").startswith("image"):
            with open(hedef_yol, "wb") as out:
                out.write(r.content)

            indirilen += 1
            print(f"[{i}/{len(dosyalar)}] İndirildi: {dosya_adi}")

        else:
            bulunamayan += 1
            print(f"[{i}/{len(dosyalar)}] Bulunamadı / Hatalı: {dosya_adi} (HTTP {r.status_code})")

    except Exception as e:
        bulunamayan += 1
        print(f"[{i}/{len(dosyalar)}] Hata: {dosya_adi} -> {e}")

    # siteyi boğmamak için küçük bekleme (önemli)
    time.sleep(0.2)

print("\nBitti!")
print(f"İndirilen: {indirilen}")
print(f"Bulunamayan/Hatalı: {bulunamayan}")
