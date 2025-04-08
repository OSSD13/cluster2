@extends('layouts.layout_user')

@section('content')
<h1 class="text-2xl font-semibold mt-4 text-left px-6">เพิ่มข้อมูล</h1>
<div class="p-4">
    <!-- ชื่อชุมชน -->
    <label class="block mt-2 text-sm">ชื่อของชุมชน</label>
    <input type="text" class="w-full p-2 border rounded" placeholder="กรอกชื่อชุมชน">

    <!-- วันที่ & ตำแหน่ง -->
    <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block mt-2 text-sm">วันที่ <span class="text-red-500">*</span></label>
            <div class="flex items-center border p-2 rounded">
                <i class="fa-solid fa-calendar-days"></i>
                <input type="date" class="w-full border-none focus:ring-0 ml-2">
            </div>
        </div>
        <div>
            <label class="block mt-2 text-sm">ตำแหน่ง <span class="text-red-500">*</span></label>
            <div class="flex items-center border p-2 rounded">
                <i class="fa-solid fa-location-dot"></i>
                <input id="location" type="text" class="w-full border-none focus:ring-0 ml-2" placeholder="เลือกตำแหน่งจากแผนที่">
                <button onclick="openGoogleMaps()" class="ml-2">➤</button>
            </div>
        </div>
    </div>

    <!-- ที่อยู่ -->
    <label class="block mt-4 text-sm">ที่อยู่ <span class="text-red-500">*</span></label>
    <div class="flex items-center border p-2 rounded">
        <input type="text" class="w-full border-none focus:ring-0">
        <button class="ml-2">➤</button>
    </div>

    <!-- ปัญหาที่พบ -->
<label class="block mt-4 text-sm">ปัญหาที่พบ <span class="text-red-500">*</span></label>
<div class="tags-input-wrapper w-full p-2 border rounded relative">
    <ul id="tags">
        <input type="text" id="tag-input" list="tagSuggestions" spellcheck="false" placeholder="พิมพ์ปัญหาแล้วกด Enter">
        <datalist id="tagSuggestions"></datalist>

    </ul>
    <button onclick="openTagModal()" class="absolute right-2 top-2 bg-blue-500 text-white px-2 py-1 rounded">+</button>
</div>

<!-- Modal สำหรับเพิ่มแท็กใหม่ -->
<div id="tagModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-80">
        <h2 class="text-lg font-semibold mb-4">เพิ่มแท็กใหม่</h2>
        <input type="text" id="newTagInput" class="w-full p-2 border rounded mb-4" placeholder="กรอกแท็กที่ต้องการเพิ่ม">
        <div class="flex justify-end gap-2">
            <button onclick="closeTagModal()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">ยกเลิก</button>
            <button onclick="addTagFromModal()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">เพิ่ม</button>
        </div>
    </div>
</div>

    <!-- รายละเอียดเพิ่มเติม -->
    <label class="block mt-4 text-sm">รายละเอียดเพิ่มเติม</label>
    <textarea class="w-full p-2 border rounded" placeholder="กรุณาระบุรายระเอียด"></textarea>

    <!-- อัปโหลดรูปภาพ -->
    <label class="block mt-4 text-sm">รูปภาพเพิ่มเติม :</label>
    <input type="file" id="imageInput" accept="image/*" class="border p-2 rounded w-full">
    <div id="preview" class="flex gap-2 mt-2"></div>

    <!-- ปุ่ม ยืนยัน -->
    <div class="flex justify-center mt-6">
        <button class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
            ยืนยันข้อมูล
        </button>
    </div>
</div>

@endsection

<style>
    .tags-input-wrapper {
        background: #fff;
        border: 1px solid #d1d5db;
        border-radius: 0.25rem;
        padding: 10px;
    }

    #tags {
        display: flex;
        flex-wrap: wrap;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    #tags li {
        display: flex;
        align-items: center;
        margin: 4px;
        padding: 5px 8px;
        background: #e5e7eb;
        border-radius: 5px;
        font-size: 14px;
    }

    #tags li.highlight {
        background: #2563eb;
        color: #fff;
    }

    #tags li .remove-tag {
        margin-left: 8px;
        font-size: 14px;
        cursor: pointer;
        color: #888;
    }

    #tags li .remove-tag:hover {
        color: #f00;
    }

    #tags input {
        flex: 1;
        padding: 5px;
        border: none;
        outline: none;
        font-size: 14px;
    }
</style>

<script>
 // ประกาศตัวแปรแบบ global
let tagsList = [];
const maxTags = 10000;

// สร้างรายการแท็กที่อนุญาตให้ใช้ได้ในช่องหลัก (จาก datalist)
const allowedTags = [
    "น้ำประปาไม่ไหล",
    "ไฟฟ้าดับ",
    "ขยะไม่เก็บ",
    "ถนนพัง",
    "น้ำท่วม",
    "เสียงดังรบกวน"
];

// ฟังก์ชันสำหรับจัดการกับแท็ก
function createTag(tagValue, fromModal = false) {
    const tags = document.getElementById('tags');
    const tagInput = document.getElementById('tag-input');

    if (!tagValue) return;

    // ตัดช่องว่างและไม่เพิ่ม # ข้างหน้า (เพื่อตรวจสอบกับ allowedTags ได้ถูกต้อง)
    tagValue = tagValue.trim();
    if (tagValue === '') return;

    // ถ้าไม่ได้มาจาก Modal ต้องตรวจสอบว่าแท็กอยู่ในรายการที่อนุญาตหรือไม่
    if (!fromModal && !allowedTags.includes(tagValue)) {
        alert("ไม่พบแท็กที่คุณเลือกในระบบ กรุณาเพิ่มแท็กใหม่");
        return;
    }

    // ตรวจสอบว่าแท็กซ้ำหรือไม่
    const formattedTag = "#" + tagValue;
    if (tagsList.includes(formattedTag)) return;

    // สร้าง element ใหม่สำหรับแท็ก
    const li = document.createElement('li');
    const span = document.createElement('span');
    span.className = 'remove-tag';
    span.innerHTML = '×';

    li.textContent = formattedTag + ' ';
    li.appendChild(span);

    // เพิ่ม event listener สำหรับลบแท็ก
    span.addEventListener('click', function() {
        removeTag(li, formattedTag);
    });

    // เพิ่มแท็กเข้าไปใน DOM และ array
    tags.insertBefore(li, tagInput);
    tagsList.push(formattedTag);

    // ล้างค่าในช่อง input
    tagInput.value = '';

    return true; // แสดงว่าเพิ่มแท็กสำเร็จ
}

function removeTag(element, tag) {
    // ลบแท็กออกจาก array
    const index = tagsList.indexOf(tag);
    if (index > -1) {
        tagsList.splice(index, 1);
    }
    // ลบ element ออกจาก DOM
    element.remove();
}

function openTagModal() {
    document.getElementById("tagModal").classList.remove("hidden");

    // ล้างค่า input เดิม
    const modalInput = document.getElementById("newTagInput");
    modalInput.value = "";
    modalInput.focus();
}

function closeTagModal() {
    document.getElementById("newTagInput").value = "";
    document.getElementById("tagModal").classList.add("hidden");
}

function addTagFromModal() {
    const tagInputValue = document.getElementById("newTagInput").value.trim();

    if (!tagInputValue) return;

    fetch("{{ route('tags.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ tag_name: tagInputValue })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            allowedTags.push(tagInputValue); // เพิ่มแท็กเข้า list ที่อนุญาต
            if (createTag(tagInputValue, true)) {
                closeTagModal();
            }
        } else {
            if (data.message === 'แท็กนี้มีอยู่แล้ว') {
                alert("แท็กนี้มีอยู่ในระบบแล้ว กรุณาเลือกแท็กอื่น");
            } else {
                alert("ไม่สามารถเพิ่มแท็กได้");
            }
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("เกิดข้อผิดพลาดในการเพิ่มแท็ก");
    });
}


// ฟังก์ชันที่จะทำงานเมื่อ DOM โหลดเสร็จ
document.addEventListener('DOMContentLoaded', function() {
    const tagInput = document.getElementById('tag-input');
    
    // โหลดแท็กจาก backend แล้วเพิ่มใน datalist + allowedTags
    fetch("{{ route('tags.fetch') }}")
    .then(response => response.json())
    .then(data => {
        const datalist = document.getElementById("tagSuggestions");
        datalist.innerHTML = '';
        data.forEach(tag => {
            const option = document.createElement("option");
            option.value = tag;
            datalist.appendChild(option);
            allowedTags.push(tag); // อัปเดต allowedTags ด้วย
        });
    })
    .catch(error => {
        console.error("เกิดข้อผิดพลาดในการโหลดแท็ก:", error);
    });

    // Event listener สำหรับการกด Enter เพื่อเพิ่มแท็ก
    tagInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            const tagValue = this.value.trim();
            createTag(tagValue, false); // fromModal = false
        }
    });

    // Event listener สำหรับการเปลี่ยนค่าใน input เพื่อตรวจสอบว่าเป็นค่าที่อยู่ใน datalist หรือไม่
    tagInput.addEventListener('change', function() {
        const tagValue = this.value.trim();
        if (tagValue && !allowedTags.includes(tagValue)) {
            alert("กรุณาเลือกแท็กจากรายการที่กำหนดเท่านั้น");
            this.value = '';
        }
    });

    // เพิ่ม event listener ให้กับปุ่มในหน้า modal
    const addTagButton = document.querySelector('[onclick="addTagFromModal()"]');
    if (addTagButton) {
        addTagButton.addEventListener('click', addTagFromModal);
    }

    // เพิ่ม event listener สำหรับการกด Enter ใน modal
    const newTagInput = document.getElementById('newTagInput');
    if (newTagInput) {
        newTagInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                addTagFromModal();
            }
        });
    }

    // จัดการกับรูปภาพที่อัปโหลด
    const imageInput = document.getElementById('imageInput');
    const preview = document.getElementById('preview');

    if (imageInput && preview) {
        imageInput.addEventListener('change', function() {
            preview.innerHTML = '';
            if (this.files) {
                for (let i = 0; i < this.files.length; i++) {
                    const file = this.files[i];
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imgContainer = document.createElement('div');
                            imgContainer.className = 'relative';

                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'h-20 w-20 object-cover rounded';

                            const removeBtn = document.createElement('button');
                            removeBtn.innerHTML = '×';
                            removeBtn.className = 'absolute top-0 right-0 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center';
                            removeBtn.onclick = function() {
                                imgContainer.remove();
                            };

                            imgContainer.appendChild(img);
                            imgContainer.appendChild(removeBtn);
                            preview.appendChild(imgContainer);
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }
        });
    }
});

// ฟังก์ชัน Google Maps
function openGoogleMaps() {
    let address = document.getElementById("location").value;
    let url = "https://www.google.com/maps/search/?api=1&query=" + encodeURIComponent(address);
    window.open(url, "_blank");
}

function initAutocomplete() {
    let input = document.getElementById("location");
    if (window.google && window.google.maps && window.google.maps.places) {
        let autocomplete = new google.maps.places.Autocomplete(input, {
            types: ['geocode'],
            componentRestrictions: { country: "TH" }
        });
    }
}

function toggleMenu() {
    let menu = document.getElementById("menu");
    if (menu) {
        menu.classList.toggle("hidden");
    }
}
</script>
