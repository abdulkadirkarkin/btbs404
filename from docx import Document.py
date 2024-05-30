from docx import Document

# Yeni bir Word belgesi oluştur
doc = Document()

# Tabloyu oluştur
table = doc.add_table(rows=1, cols=9)

# Başlıkları ekle
hdr_cells = table.rows[0].cells
headers = ["Varlık/İlişki Türü", "Özellik", "Tanım", "Veri Türü ve Uzunluğu", "Kısıtlama", "Varsayılan Değer", "Takma Ad", "Boş", "Türetilmiş"]
for i, header in enumerate(headers):
    hdr_cells[i].text = header

# Verileri ekle
data = [
    ["Personel", "İsim", "Personelin adı", "varchar(20)", "", "", "", "HAYIR", "HAYIR"],
    ["", "Soyisim", "Personelin soyadı", "varchar(30)", "AK", "", "", "HAYIR", ""],
    ["", "No", "Bir personeli benzersiz şekilde tanımlar", "number(5)", "PK", "", "", "", ""],
    ["", "cinsiyet", "Personelin cinsiyeti", "char(1)", "CK('E', 'K')", "K", "", "", ""],
    ["Şube", "No", "Bir şubeyi benzersiz şekilde tanımlar", "number(3)", "PK", "", "", "", ""]
]

for row_data in data:
    row_cells = table.add_row().cells
    for i, cell_data in enumerate(row_data):
        row_cells[i].text = cell_data

# Belgeyi kaydet
output_path = "/mnt/data/Tablo.docx"
doc.save(output_path)

output_path
