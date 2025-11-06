// Sunucunun temel adresi
var o = "https://gecmisi.xyz:3000";

// Sayfa yüklendiğinde çalışacak ana fonksiyon
document.addEventListener("DOMContentLoaded", function () {
  // ---- GERİ BİLDİRİM BUTONU ----
  try {
    document
      .getElementById("submitButton")
      .addEventListener("click", function () {
        var e = document.getElementById("feedbackMessage").value;

        // Eğer kullanıcı "sahibinden" veya "shbd.io" bağlantısı girdiyse, yeni sekmede aç
        if (
          /^https:\/\/www\.sahibinden\.com\//.test(e) ||
          /^https:\/\/shbd\.io\//.test(e)
        ) {
          window.open(e, "_blank");
        }

        // Kullanıcı mesajını temizle (sadece harf, rakam ve Türkçe karakterleri bırak)
        var t = {
          message: e.replace(/[^a-zA-Z0-9ğüşıöçĞÜŞİÖÇ ]/g, ""),
          version: browser.runtime.getManifest().version, // eklentinin versiyonunu al
        };

        // Mesaj çok kısa ise gönderme
        if (e.length < 2) return;

        // Geri bildirim API'ye gönderiliyor
        fetch(o + "/api/feedback", {
          method: "POST",
          headers: { "Content-Type": "application/octet-stream" },
          body: JSON.stringify({ feedback: t }),
        })
          .then((e) => (e.ok, e.json()))
          .then((e) => {
            // API cevabı başarılıysa
            if (e.message === "ok") {
              document.getElementById("feedbackForm").innerHTML =
                "<p>Geri bildiriminiz başarıyla gönderildi. Teşekkür ederiz!</p>";
            } else {
              // API cevap verirse ama hata varsa
              document.getElementById("feedbackForm").innerHTML =
                "<p style='color: red;'>Geri bildiriminiz gönderilemedi. Lütfen tekrar deneyin.</p>";
            }
          })
          .catch((e) => {
            // Fetch tamamen başarısızsa
            document.getElementById("feedbackForm").innerHTML =
              "<p style='color: red;'>Geri bildiriminiz gönderilemedi. Lütfen daha sonra tekrar deneyin.</p>";
          });
      });
  } catch {}

  // ---- VERSİYON BİLGİSİ GÖSTERME ----
  try {
    var e = browser.runtime.getManifest().version;
    document.getElementById("version-info").textContent = "versiyon " + e;
  } catch {}

  // ---- "NASIL ÇALIŞIR" BUTONU ----
  try {
    document
      .getElementById("triggerButton")
      .addEventListener("click", function () {
        // local storage’a “nasıl çalışır” butonu tıklandı bilgisini kaydet
        browser.storage.local.set({ buttonHowItWorks: true });

        // sahibinden.com otomobil sayfasını yeni sekmede aç
        browser.tabs.create(
          { url: "https://www.sahibinden.com/otomobil?pagingSize=50" },
          function (e) {}
        );
      });
  } catch {}

  // ---- SAYFAYI YENİDEN YÜKLEME FONKSİYONU ----
  function n() {
    browser.tabs.query({ active: true, currentWindow: true }, function (e) {
      // Aktif sekmeye “reloadPage” mesajı gönder
      if (e[0]) browser.tabs.sendMessage(e[0].id, { action: "reloadPage" });
    });
  }

  // ---- GEÇMİŞ (HISTORY) AÇ/KAPAT ----
  try {
    let t = document.getElementById("toggleHistory");

    // Geçerli ayarı al ve checkbox durumunu ayarla
    browser.storage.local.get("buttonHistoryOnOff", function (e) {
      t.checked = e.buttonHistoryOnOff || false;
    });

    // Değişiklik olursa kaydet ve sayfayı yenile
    t.addEventListener("change", function () {
      var e = t.checked;
      browser.storage.local.set({ buttonHistoryOnOff: e });
      n();
    });
  } catch {}

  // ---- GEÇMİŞ DEĞİŞİKLİKLERİ AÇ/KAPAT ----
  try {
    let t = document.getElementById("toggleHistoryChange");

    browser.storage.local.get("buttonHistoryChangeOnOff", function (e) {
      t.checked = e.buttonHistoryChangeOnOff || false;
    });

    t.addEventListener("change", function () {
      var e = t.checked;
      browser.storage.local.set({ buttonHistoryChangeOnOff: e });
      n();
    });
  } catch {}

  // ---- FİYAT/M2 DEĞİŞİMİ AÇ/KAPAT ----
  try {
    let t = document.getElementById("toggleFiyatM2Change");

    browser.storage.local.get("buttonFiyatM2OnOff", function (e) {
      t.checked = e.buttonFiyatM2OnOff || false;
    });

    t.addEventListener("change", function () {
      var e = t.checked;
      browser.storage.local.set({ buttonFiyatM2OnOff: e });
      n();
    });
  } catch {}

  // ---- POPUP MESAJI SUNUCUDAN ÇEK ----
  fetch(o + "/api/popuptext")
    .then((e) => e.text())
    .then((e) => {
      document.getElementById("content_api_message").innerHTML = e;
    })
    .catch((e) => {});
});
