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
    <!-- ปัญหาที่พบ -->
<div class="relative mt-4">
    <label class="block text-sm">ปัญหาที่พบ <span class="text-red-500">*</span></label>
    <div class="tags-input-wrapper w-full border rounded p-2 bg-white">
        <ul id="tags" class="flex flex-wrap gap-2">
            <input type="text" id="tag-input" spellcheck="false" placeholder="พิมพ์ปัญหา" class="flex-1 outline-none text-sm p-1">
        </ul>
    </div>
    <ul id="autocomplete-list" class="absolute z-10 bg-white border rounded mt-1 w-full max-h-40 overflow-y-auto shadow hidden text-sm">
        <!-- Suggestions will appear here -->
    </ul>
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
    #autocomplete-list li {
    padding: 8px 12px;
    cursor: pointer;
    transition: background 0.2s;
}

#autocomplete-list li:hover {
    background-color: #f3f4f6; /* Tailwind gray-100 */
}
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
let allowedTags = [];
const tagSuggestions = [];
const maxTags = 10000;

// ฟังก์ชันสำหรับจัดการกับแท็ก
function createTag(tagValue) {
    const tags = document.getElementById('tags');
    const tagInput = document.getElementById('tag-input');

    if (!tagValue) return;

    // ตัดช่องว่าง
    tagValue = tagValue.trim();
    if (tagValue === '') return;

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

// ฟังก์ชันเพิ่มแท็กใหม่ (ทั้งแท็กที่มีอยู่หรือสร้างใหม่)
function handleTagInput(tagValue) {
    if (!tagValue) return;

    // ตรวจสอบว่าแท็กนี้มีอยู่แล้วในระบบหรือไม่
    if (allowedTags.includes(tagValue)) {
        // ถ้ามีอยู่แล้ว เพิ่มแท็กได้เลย
        createTag(tagValue);
    } else {
        // ถ้ายังไม่มี ส่งข้อมูลไปบันทึกแท็กใหม่ที่ backend ก่อน
        fetch("{{ route('tags.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ tag_name: tagValue })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // เพิ่มแท็กเข้า list ที่อนุญาต
                allowedTags.push(tagValue);

                // เพิ่มแท็กใน datalist
                const datalist = document.getElementById("tagSuggestions");
                const option = document.createElement("option");
                option.value = tagValue;
                datalist.appendChild(option);

                // สร้างแท็กและแสดงในรายการ
                createTag(tagValue);
            } else {
                if (data.message === 'แท็กนี้มีอยู่แล้ว') {
                    // กรณีนี้ไม่ควรเกิดขึ้นแล้ว แต่เผื่อไว้
                    createTag(tagValue);
                } else {
                    alert("ไม่สามารถเพิ่มแท็กได้: " + data.message);
                }
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("เกิดข้อผิดพลาดในการเพิ่มแท็ก");
        });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const tagInput = document.getElementById('tag-input');
    const autoList = document.getElementById('autocomplete-list');
    const tagsContainer = document.getElementById('tags');

    // โหลดแท็กจาก backend
    fetch("{{ route('tags.fetch') }}")
        .then(response => response.json())
        .then(data => {
            tagSuggestions.push(...data);
            allowedTags.push(...data);
        });

    // สร้างแท็ก
    function createTag(tagValue) {
    if (!tagValue) return;
    tagValue = tagValue.trim();

    if (tagsList.includes(tagValue)) return; // ไม่ใส่ # ตรงนี้

    const li = document.createElement('li');
    const span = document.createElement('span');
    span.className = 'remove-tag';
    span.textContent = '×';

    li.textContent = "#" + tagValue + ' ';
    li.appendChild(span);

    span.addEventListener('click', function () {
        removeTag(li, tagValue);
    });

    tagsContainer.insertBefore(li, tagInput);
    tagsList.push(tagValue); // เก็บแบบไม่มี # เพื่อให้เปรียบเทียบง่าย
    tagInput.value = '';
    autoList.classList.add('hidden');
}


    function removeTag(element, tag) {
        const index = tagsList.indexOf(tag);
        if (index > -1) tagsList.splice(index, 1);
        element.remove();
    }

    function handleTagInput(tagValue) {
    tagValue = tagValue.trim();
    if (!tagValue) return;

    if (tagsList.includes(tagValue)) return; // ป้องกันซ้ำก่อน

    if (allowedTags.includes(tagValue)) {
        createTag(tagValue);
    } else {
        fetch("{{ route('tags.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ tag_name: tagValue })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                allowedTags.push(tagValue);
                tagSuggestions.push(tagValue);
                createTag(tagValue);
            } else if (data.message === 'แท็กนี้มีอยู่แล้ว') {
                createTag(tagValue); // ป้องกัน fallback ซ้ำ
            } else {
                alert("ไม่สามารถเพิ่มแท็กได้: " + data.message);
            }
        })
        .catch(err => {
            console.error("Error:", err);
            alert("เกิดข้อผิดพลาดในการเพิ่มแท็ก");
        });
    }
}


    // Autocomplete
    tagInput.addEventListener('input', function () {
        const value = this.value.toLowerCase();
        autoList.innerHTML = '';

        if (!value) {
            autoList.classList.add('hidden');
            return;
        }

        const filtered = tagSuggestions.filter(tag => tag.toLowerCase().includes(value));
        if (filtered.length === 0) {
            autoList.classList.add('hidden');
            return;
        }

        filtered.forEach(tag => {
            const item = document.createElement('li');
            item.textContent = tag;
            item.addEventListener('click', () => {
                handleTagInput(tag);
                autoList.classList.add('hidden');
            });
            autoList.appendChild(item);
        });

        autoList.classList.remove('hidden');
    });

    // Event listener สำหรับการกด Enter เพื่อเพิ่มแท็ก (เดสก์ท็อป)
tagInput.addEventListener('keyup', function(e) {
    if (e.key === 'Enter') {
        const tagValue = this.value.trim();
        if (tagValue) {
            e.preventDefault(); // ป้องกัน form ส่งถ้าอยู่ใน <form>
            handleTagInput(tagValue);
        }
    }
});

// Event listener สำหรับผู้ใช้มือถือ (กด "Done" บนคีย์บอร์ดมือถือ)
tagInput.addEventListener('change', function() {
    const tagValue = this.value.trim();
    if (tagValue) {
        handleTagInput(tagValue);
    }
});

// สำรองไว้ในกรณีที่บางอุปกรณ์มือถือใช้ blur
tagInput.addEventListener('blur', function() {
    const tagValue = this.value.trim();
    if (tagValue) {
        handleTagInput(tagValue);
    }
});
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
