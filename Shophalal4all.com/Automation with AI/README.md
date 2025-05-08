## 🛠 Technologie
- Google Apps Script (JavaScript)
- OpenAI API
- WooCommerce + wtyczka FlexStock
- Google Sheets

W tym projekcie połączyłem stronę opartą na WooCommerce z Google Sheets w celu ułatwienia zarządzania produktami. Do synchronizacji danych wykorzystałem wtyczkę **FlexStock**, która umożliwia łatwe dodawanie i edytowanie produktów bezpośrednio z arkusza kalkulacyjnego.

Do sklepu było dodane 4tyś produktów i trzeba było do nich dodać opisy i wpadłem na pomysł, rozszerzyłem funkcjonalność arkusza Google Sheets o integrację z **ChatGPT** (model GPT-3.5-turbo), dzięki czemu można generować treści lub funkcje bezpośrednio z poziomu arkusza (użylem tego do wygenerowania krótkich opisów dla wszystkich produktów na raz, zaoszczędziło to bardzo dużo czasu i projekt został dostarczony na czas). 

## 🧠 Jak to działa
1. Sklep WooCommerce synchronizuje produkty z Google Sheets przez FlexStock.
2. W arkuszu można dodać prompt do ChatGPT.
3. Funkcja `GPTFunction(prompt)` zwraca odpowiedź od modelu GPT-3.5 i zapisuje ją w komórce.

