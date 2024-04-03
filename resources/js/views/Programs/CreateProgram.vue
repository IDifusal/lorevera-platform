<template>
    <div class="d-flex justify-content-between">
        <h3>Creating Program{{ program.name }}</h3>
    </div>
    <v-form
        ref="form"
        id="create-form"
        v-model="valid"
        @submit.prevent="createNewItem()"
    >
        <v-row>
            <v-col>
                <h4>Name</h4>
                <v-text-field
                    v-model="program.name"
                    :rules="[rules.required]"
                    class="field"
                    required
                    flat
                ></v-text-field>
            </v-col>
            <v-col>
                <h4>Sub name</h4>
                <v-text-field
                    v-model="program.subtitle"
                    :rules="[rules.required]"
                    class="field"
                    required
                    flat
                ></v-text-field>
            </v-col>            
            <v-col>
                <h4>Tag</h4>
                <v-text-field
                    v-model="program.tag"
                    :rules="[rules.required]"
                    class="field"
                    required
                    flat
                ></v-text-field>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <svg
                    width="38"
                    height="38"
                    viewBox="0 0 38 38"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <g clip-path="url(#clip0_1_102)">
                        <path
                            d="M30.5121 11.3117L32.7874 9.03648L30.5486 6.79685L28.1146 9.23083C25.8911 7.65509 23.2964 6.68393 20.5846 6.4125V3.16667H23.7513V0H14.2513V3.16667H17.418V6.4125C14.7063 6.68393 12.1116 7.65509 9.88804 9.23083L7.45406 6.79685L5.21523 9.03648L7.49048 11.3117C5.36667 13.5604 3.94799 16.3819 3.40964 19.4277C2.8713 22.4735 3.23686 25.6104 4.46118 28.4508C5.68551 31.2912 7.71497 33.7109 10.299 35.4109C12.8829 37.1109 15.9083 38.0168 19.0013 38.0168C22.0944 38.0168 25.1197 37.1109 27.7037 35.4109C30.2877 33.7109 32.3171 31.2912 33.5414 28.4508C34.7658 25.6104 35.1313 22.4735 34.593 19.4277C34.0546 16.3819 32.636 13.5604 30.5121 11.3117ZM19.0013 34.8333C16.4961 34.8333 14.0471 34.0905 11.9641 32.6986C9.88107 31.3068 8.25755 29.3285 7.29884 27.014C6.34013 24.6995 6.08928 22.1526 6.57803 19.6955C7.06678 17.2384 8.27316 14.9814 10.0446 13.21C11.8161 11.4385 14.0731 10.2321 16.5302 9.74339C18.9873 9.25464 21.5341 9.50548 23.8486 10.4642C26.1632 11.4229 28.1414 13.0464 29.5333 15.1294C30.9251 17.2125 31.668 19.6614 31.668 22.1667C31.6642 25.5249 30.3285 28.7445 27.9538 31.1192C25.5792 33.4938 22.3596 34.8296 19.0013 34.8333Z"
                            fill="#12B46B"
                        />
                        <path
                            d="M19 12.666V22.166H9.5C9.5 24.0449 10.0572 25.8817 11.101 27.4439C12.1449 29.0062 13.6286 30.2238 15.3645 30.9429C17.1004 31.6619 19.0105 31.85 20.8534 31.4835C22.6962 31.1169 24.3889 30.2121 25.7175 28.8835C27.0461 27.5549 27.9509 25.8622 28.3175 24.0194C28.684 22.1766 28.4959 20.2664 27.7769 18.5305C27.0578 16.7946 25.8402 15.3109 24.2779 14.2671C22.7157 13.2232 20.8789 12.666 19 12.666Z"
                            fill="#12B46B"
                        />
                    </g>
                    <defs>
                        <clipPath id="clip0_1_102">
                            <rect width="38" height="38" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                Workout
                <v-text-field
                    v-model="program.duration_per_workout"
                    :rules="[rules.required]"
                    class="field"
                    required
                    flat
                ></v-text-field>
            </v-col>
            <v-col>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="34"
                    height="34"
                    viewBox="0 0 34 34"
                    fill="none"
                >
                    <g clip-path="url(#clip0_1_111)">
                        <path
                            d="M8.30715 8.08603H8.79358C9.53282 8.08603 10.1321 7.48658 10.1321 6.74755V1.67235C10.1321 0.933315 9.53282 0.333943 8.79358 0.333943H8.30715C7.56798 0.333943 6.96875 0.933315 6.96875 1.67235V6.74755C6.96875 7.48658 7.56798 8.08603 8.30715 8.08603ZM25.4749 8.05286H25.9613C26.7005 8.05286 27.2997 7.45349 27.2997 6.71439V1.63911C27.2997 0.900153 26.7005 0.300781 25.9613 0.300781H25.4749C24.7356 0.300781 24.1363 0.900153 24.1363 1.63911V6.71432C24.1365 7.45349 24.7357 8.05286 25.4749 8.05286Z"
                            fill="#DB00FF"
                        />
                        <path
                            d="M31.8241 3.05469H28.389V7.06562C28.389 8.4036 27.3006 9.14158 25.9627 9.14158H25.4763C24.1383 9.14158 23.0498 8.05305 23.0498 6.71507V3.05469H11.2213V6.74823C11.2213 8.08621 10.1329 9.17475 8.7949 9.17475H8.30848C6.97056 9.17475 5.8821 8.08621 5.8821 6.74823V3.05469H2.17594C0.976144 3.05469 0 4.03083 0 5.2307V31.5241C0 32.724 0.976144 33.7001 2.17594 33.7001H31.8241C33.0239 33.7001 34 32.724 34 31.5241V5.2307C34.0001 4.0309 33.0239 3.05469 31.8241 3.05469ZM31.8241 31.5241H2.17601L2.17594 11.668H31.8245L31.8257 31.524L31.8241 31.5241Z"
                            fill="#DB00FF"
                        />
                        <path
                            d="M18.1224 18.3269H22.0294C22.1038 18.3269 22.1752 18.2973 22.2277 18.2447C22.2803 18.1921 22.3099 18.1208 22.3099 18.0464V14.6633C22.3099 14.5889 22.2803 14.5175 22.2277 14.465C22.1752 14.4124 22.1038 14.3828 22.0294 14.3828H18.1224C18.048 14.3828 17.9767 14.4124 17.9241 14.465C17.8715 14.5175 17.842 14.5889 17.842 14.6633V18.0464C17.842 18.1208 17.8715 18.1921 17.9241 18.2447C17.9767 18.2973 18.048 18.3269 18.1224 18.3269ZM24.4986 18.3269H28.4056C28.48 18.3269 28.5513 18.2973 28.6039 18.2447C28.6565 18.1921 28.6861 18.1208 28.6861 18.0464V14.6633C28.6861 14.5889 28.6565 14.5175 28.6039 14.465C28.5513 14.4124 28.48 14.3828 28.4056 14.3828H24.4986C24.4242 14.3828 24.3529 14.4124 24.3003 14.465C24.2477 14.5175 24.2181 14.5889 24.2181 14.6633V18.0464C24.2181 18.1208 24.2477 18.1921 24.3003 18.2447C24.3529 18.2973 24.4242 18.3269 24.4986 18.3269ZM5.37028 23.8656H9.27724C9.35162 23.8656 9.42295 23.836 9.47554 23.7834C9.52814 23.7308 9.55768 23.6595 9.55768 23.5851V20.2019C9.55768 20.1275 9.52814 20.0562 9.47554 20.0036C9.42295 19.951 9.35162 19.9214 9.27724 19.9214H5.37028C5.29591 19.9214 5.22458 19.951 5.17198 20.0036C5.11939 20.0562 5.08984 20.1275 5.08984 20.2019V23.5851C5.08984 23.6595 5.11939 23.7308 5.17198 23.7834C5.22458 23.836 5.29591 23.8656 5.37028 23.8656ZM11.7464 23.8656H15.6533C15.7277 23.8656 15.7991 23.836 15.8516 23.7834C15.9042 23.7308 15.9338 23.6595 15.9338 23.5851V20.2019C15.9338 20.1275 15.9042 20.0562 15.8516 20.0036C15.7991 19.951 15.7277 19.9214 15.6533 19.9214H11.7464C11.672 19.9214 11.6007 19.951 11.5481 20.0036C11.4955 20.0562 11.4659 20.1275 11.4659 20.2019V23.5851C11.4659 23.6595 11.4955 23.7308 11.5481 23.7834C11.6007 23.836 11.672 23.8656 11.7464 23.8656ZM18.1225 23.8656H22.0294C22.1038 23.8656 22.1752 23.836 22.2277 23.7834C22.2803 23.7308 22.3099 23.6595 22.3099 23.5851V20.2019C22.3099 20.1275 22.2803 20.0562 22.2277 20.0036C22.1752 19.951 22.1038 19.9214 22.0294 19.9214H18.1225C18.0481 19.9214 17.9768 19.951 17.9242 20.0036C17.8716 20.0562 17.842 20.1275 17.842 20.2019V23.5851C17.842 23.6595 17.8716 23.7308 17.9242 23.7834C17.9768 23.836 18.0481 23.8656 18.1225 23.8656ZM24.4986 23.8656H28.4056C28.48 23.8656 28.5513 23.836 28.6039 23.7834C28.6565 23.7308 28.6861 23.6595 28.6861 23.5851V20.2019C28.6861 20.1275 28.6565 20.0562 28.6039 20.0036C28.5513 19.951 28.48 19.9214 28.4056 19.9214H24.4986C24.4242 19.9214 24.3529 19.951 24.3003 20.0036C24.2477 20.0562 24.2181 20.1275 24.2181 20.2019V23.5851C24.2181 23.6595 24.2477 23.7308 24.3003 23.7834C24.3529 23.836 24.4242 23.8656 24.4986 23.8656ZM9.27724 25.4601H5.37035C5.29598 25.4601 5.22465 25.4897 5.17205 25.5423C5.11946 25.5949 5.08991 25.6662 5.08991 25.7406V29.1238C5.08991 29.1982 5.11946 29.2695 5.17205 29.3221C5.22465 29.3747 5.29598 29.4043 5.37035 29.4043H9.27731C9.35169 29.4043 9.42302 29.3747 9.47562 29.3221C9.52821 29.2695 9.55775 29.1982 9.55775 29.1238V25.7406C9.55772 25.6662 9.52815 25.5949 9.47555 25.5423C9.42295 25.4897 9.35162 25.4602 9.27724 25.4601ZM15.6534 25.4601H11.7465C11.6721 25.4601 11.6007 25.4897 11.5482 25.5423C11.4956 25.5949 11.466 25.6662 11.466 25.7406V29.1238C11.466 29.1982 11.4956 29.2695 11.5482 29.3221C11.6007 29.3747 11.6721 29.4043 11.7465 29.4043H15.6534C15.7278 29.4043 15.7991 29.3747 15.8517 29.3221C15.9043 29.2695 15.9339 29.1982 15.9339 29.1238V25.7406C15.9339 25.6662 15.9043 25.5949 15.8517 25.5423C15.7991 25.4897 15.7278 25.4601 15.6534 25.4601ZM22.0296 25.4601H18.1226C18.0482 25.4601 17.9768 25.4897 17.9243 25.5423C17.8717 25.5949 17.8421 25.6662 17.8421 25.7406V29.1238C17.8421 29.1982 17.8717 29.2695 17.9243 29.3221C17.9768 29.3747 18.0482 29.4043 18.1226 29.4043H22.0296C22.104 29.4043 22.1753 29.3747 22.2279 29.3221C22.2805 29.2695 22.31 29.1982 22.31 29.1238V25.7406C22.31 25.6662 22.2805 25.5949 22.2279 25.5423C22.1753 25.4897 22.104 25.4601 22.0296 25.4601ZM28.4056 25.4601H24.4986C24.4242 25.4601 24.3529 25.4897 24.3003 25.5423C24.2477 25.5949 24.2181 25.6662 24.2181 25.7406V29.1238C24.2181 29.1982 24.2477 29.2695 24.3003 29.3221C24.3529 29.3747 24.4242 29.4043 24.4986 29.4043H28.4056C28.48 29.4043 28.5513 29.3747 28.6039 29.3221C28.6565 29.2695 28.6861 29.1982 28.6861 29.1238V25.7406C28.6861 25.6662 28.6565 25.5949 28.6039 25.5423C28.5513 25.4897 28.48 25.4601 28.4056 25.4601Z"
                            fill="#DB00FF"
                        />
                    </g>
                    <defs>
                        <clipPath id="clip0_1_111">
                            <rect width="34" height="34" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                Per Week
                <v-text-field
                    v-model="program.duration_per_week"
                    :rules="[rules.required]"
                    class="field"
                    required
                    flat
                ></v-text-field>
            </v-col>
            <v-col>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="40"
                    height="40"
                    viewBox="0 0 40 40"
                    fill="none"
                >
                    <path
                        d="M31.1193 0H21.1722V10H18.8284V0H8.88133C8.88133 7.81086 1.32812 9.16758 1.32812 22.3163C1.32812 27.5 3.73492 34.9617 4.88148 40H16.0248L17.6863 27.5838C16.2579 28.647 14.4913 29.28 12.5798 29.287C10.6946 29.3846 8.76469 29.1932 7.02352 28.418L7.97672 26.2769C9.38844 26.9053 11.023 27.0527 12.548 26.9434C16.011 26.9434 18.8285 24.1259 18.8285 20.6628H21.1723C21.1723 24.1259 23.9897 26.9434 27.4528 26.9434C28.9962 27.0545 30.6536 26.9013 32.0775 26.2527L33.0491 28.3857C31.4675 29.106 29.6259 29.401 27.421 29.287C25.5094 29.28 23.7428 28.647 22.3145 27.5838L23.9759 40H35.1191C36.2657 34.9617 38.6725 27.5 38.6725 22.3163C38.6725 9.16758 31.1193 7.81086 31.1193 0ZM14.4908 13.3286L12.8335 11.6713L15.3335 9.17133L16.9908 10.8286L14.4908 13.3286ZM25.5098 13.3286L23.0098 10.8286L24.6671 9.17133L27.1671 11.6713L25.5098 13.3286Z"
                        fill="#FF5757"
                    />
                </svg>
                Focus
                <UploadImage
                    @cleanImg="clearImgFocus"
                    @chasnged="onFileChangeFocus"
                />
                <v-text-field
                    v-model="program.focus"
                    :rules="[rules.required]"
                    class="field"
                    required
                    flat
                ></v-text-field>
            </v-col>
            <v-col>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="38"
                    height="38"
                    viewBox="0 0 38 38"
                    fill="none"
                >
                    <path
                        d="M28.487 15.4019L29.3717 11.5306H24.6098L24.408 12.6825C20.1627 10.3134 15.1573 11.9938 13.2811 12.7834L13.1148 11.5306H8.53704L9.50485 15.4078C8.13329 16.9694 1.44172 25.5253 10.253 34.4316C11.0285 35.1996 12.0769 35.6287 13.1683 35.625H24.8295C25.921 35.6287 26.9693 35.1996 27.7449 34.4316C36.568 25.5134 29.8467 16.9516 28.487 15.4019ZM8.24016 10.3431H12.9545L12.7408 8.76375C12.7138 8.54825 12.7327 8.32949 12.7961 8.12179C12.8596 7.91408 12.9662 7.72211 13.1089 7.55844C13.2506 7.39544 13.4258 7.26492 13.6226 7.17578C13.8193 7.08663 14.0329 7.04096 14.2489 7.04188H23.5767C23.7986 7.04189 24.0179 7.09037 24.2191 7.18391C24.4203 7.27745 24.5987 7.4138 24.7417 7.58343C24.8848 7.75307 24.9891 7.95189 25.0473 8.16602C25.1056 8.38014 25.1163 8.6044 25.0789 8.82313L24.8117 10.3431H29.6448L29.6805 10.1947C29.8952 9.25838 29.8961 8.28571 29.6831 7.34901C29.4701 6.41231 29.0487 5.53567 28.4502 4.78428C27.8517 4.03289 27.0915 3.42607 26.2262 3.00895C25.3609 2.59184 24.4126 2.37515 23.452 2.375H14.4389C13.4683 2.37478 12.5103 2.59562 11.6378 3.02078C10.7652 3.44593 10.0009 4.06423 9.40291 4.82877C8.8049 5.59331 8.38887 6.484 8.18637 7.43328C7.98388 8.38256 8.00024 9.36549 8.23422 10.3075L8.24016 10.3431Z"
                        fill="#007BFF"
                    />
                </svg>
                Based
                <UploadImage
                    @cleanImg="clearImgBased"
                    @changed="onFileChangeBased"
                />
                <v-text-field
                    v-model="program.based"
                    :rules="[rules.required]"
                    class="field"
                    required
                    flat
                ></v-text-field>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <h4>Price</h4>
                <v-text-field
                    v-model="program.price"
                    :rules="[rules.required]"
                    class="field"
                    type="number"
                    required
                    flat
                ></v-text-field>
            </v-col>
            <v-col>
                <h4>Featured Image</h4>
                <UploadImage @cleanImg="clearImg" @changed="onFileChange" />
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <h4>Overview</h4>
                <editor-content :editor="overview" />
            </v-col>
            <v-col>
                <h4>Introduction</h4>
                <editor-content :editor="introduction" />
            </v-col>
        </v-row>
        <div v-for="(week, index) in selectedDays" :key="week.id" class="mb-5">
            <div style="height: 20px;" ></div>
            <h3>Group # {{ index }}</h3>
            <v-select
                v-model="week.days"
                :items="days"
                item-value="id"
                multiple
                outline
                return-object
            ></v-select>
            <v-data-table
                :items="week.days"
                :items-per-page="100"
                :headers="headers"
                class="elevation-1 pt-5"
            >
                <template v-slot:item="props">
                    <tr>
                        <td>{{ props.item.id }}</td>
                        <td>Day # 0{{ props.index + 1 }}</td>
                        <td>
                            <img
                                style="
                                    width: 80px;
                                    height: 80px;
                                    object-fit: contain;
                                "
                                :src="returnImagePath(props.item.image)"
                            />
                        </td>
                        <td>{{ props.item.title }}</td>
                        <td>{{ props.item.name }}</td>
                    </tr>
                </template>
            </v-data-table>
        </div>
        <v-btn
            color="primary"
            @click="addWeek()"
            class="mt-5"
        >
            Add Week
        </v-btn>
        <v-btn
            color="primary"
            @click="createNewItem()"
            :disabled="!valid"
            class="mt-5"
        >
            Submit
        </v-btn>
    </v-form>
</template>
<script setup>
import UploadImage from "../../components/UploadImage.vue";
import { useEditor, EditorContent } from "@tiptap/vue-3";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import StarterKit from "@tiptap/starter-kit";
const valid = ref(false);
const router = useRouter();
const activeImageUpload = ref(null);
const onFileChange = (file) => {
    activeImageUpload.value = file[0];
};
const clearImg = () => {
    activeImageUpload.value = null;
};
const imageUploadFocus = ref(null);
const onFileChangeFocus = (file) => {
    imageUploadFocus.value = file[0];
};
const clearImgFocus = () => {
    imageUploadFocus.value = null;
};
const imageUploadBased = ref(null);
const onFileChangeBased = (file) => {
    imageUploadBased.value = file[0];
};
const clearImgBased = () => {
    imageUploadBased.value = null;
};

const returnImagePath = (imageName) => {
    const baseUrl = `${window.location.protocol}//${window.location.host}`;
    return `${baseUrl}/storage/${imageName}`;
};
const headers = ref([
    {
        title: "id",
        value: "id",
    },
    {
        title: "day",
        align: "start",
        sortable: false,
        value: "day",
    },
    {
        title: "Image",
        align: "start",
        sortable: false,
        value: "image",
    },
    {
        title: "Name",
        align: "start",
        sortable: false,
        value: "name",
    },
]);
const selectedDays = ref([
    {
        week: 1,
        days: [],
    },
]);
const addWeek = () => {
    selectedDays.value.push({
        week: selectedDays.value.length + 1,
        days: [],
    });
};

const overview = useEditor({
    content: "<p>Content <strong> add here</strong></p>",
    extensions: [StarterKit],
});
const introduction = useEditor({
    content: "<p>Content <strong> add here</strong></p>",
    extensions: [StarterKit],
});
const rules = { required: (value) => !!value || "Required Field" };
const program = ref({});
const days = ref([]);
const getDaysList = async () => {
    try {
        const { data } = await axios.get("/api/web/list-days");
        days.value = data;
    } catch (error) {
        console.error(error);
    }
};
const createNewItem = async () => {
    console.log("submited", program.value);

    let errors = false;
    const formData = new FormData();
    formData.append("name", program.value.name);
    formData.append("subtitle", program.value.subtitle);
    formData.append("tag", program.value.tag);
    formData.append("duration_per_workout", program.value.duration_per_workout);
    formData.append("duration_per_week", program.value.duration_per_week);
    formData.append("focus", program.value.focus);
    formData.append("based", program.value.based);
    formData.append("price", program.value.price);
    formData.append("overview", overview.value.getHTML());
    formData.append("introduction", introduction.value.getHTML());
    let weekKeyList = [];
    selectedDays.value.forEach((weekGroup, index) => {
        if (weekGroup.days.length === 0) {
            alert(`Please select at least one day for week ${weekGroup.week}`);
            errors = true;
            return; // Stop processing further if validation fails
        }

        // If validation passes, prepare the days data for this week
        const weekKey = `daysWeek${weekGroup.week}`; // Dynamic key based on week number
        const dayIds = weekGroup.days.map(day => day.id); // Assuming each 'day' has an 'id'
        weekKeyList.push( { [weekKey]: dayIds });
    });
    formData.append("weekKeys", JSON.stringify(weekKeyList)); // Append as JSON string

    if (errors) {
        return;
    }
    if (activeImageUpload.value) {
        formData.append("image", activeImageUpload.value);
    }

    try {
        const { data } = await axios.post("/api/web/store-package", formData);
        console.log(data);
        // router.push({ name: "Programs" });
    } catch (error) {
        console.error(error);
    }
};
onMounted(async () => {
    await getDaysList();
});
</script>
