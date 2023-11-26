import React from "@inertiajs/react";
import axios from "axios";
import {useEffect, useRef, useState} from "react";
import HomeLayout from "../Layout/HomeLayout";
import Editor from '@toast-ui/editor';

export default function Create() {
    const editorRef = useRef(null);
    const [tagData, setTagData] = useState([]);
    const [boardData, setBoardData] = useState([]);
    const [formData, setFormData] = useState([]);

    useEffect(() => {
        if (editorRef.current !== null) {
            const editorOption: any = {
                initialEditType: 'wysiwyg',
                el: editorRef.current,
                height: '500px',
                previewStyle: 'vertical',
            };
            const editor: Editor = new Editor(editorOption);

            axios.get(`/api/v1/board/`)
                .then((res) => {
                    setBoardData(res.data.data);
                });

            axios.get(`/api/v1/board/tag/all`)
                .then((res) => {
                    setTagData(res.data.tagList);
                });
        }
    }, []);

    return (
        <HomeLayout children>
            <div className="flex justify-end mb-3">
                <button type="button" className="btn mr-3">전송</button>
                <button type="button" className="btn">취소</button>
            </div>
            <div className="flex flex-col mt-5 mb-5">
                <p><strong>게시판 선택</strong></p>
                <select className="mt-3">
                    {
                        boardData.map((ele: any, idx :number) => {
                            return ele.map((el, id: number) => (
                                <option value={el.id} key={id}>{el.name}</option>
                            ));
                        })
                    }
                </select>
            </div>
            <div className="flex flex-col mt-5 mb-5">
                <p><strong>태그 선택</strong><br/>게시판명과 동일한 태그는 꼭 선택해줘야 합니다.</p>
                <ul className="flex mt-3">
                    {
                        tagData.map((ele: any, idx: number) => {
                            return (
                                <li key={idx}>
                                    <label className="mr-3"><input type="checkbox" name="tag_list[]"/> {ele.name_ko}
                                    </label>
                                </li>
                            );
                        })
                    }
                </ul>
            </div>
            <div id="editor" ref={editorRef} className="w-ful lflex justify-center px-4 py-4 bg-base-200"></div>
            <div className="flex justify-center mt-3">
                <button type="button" className="btn mr-3" data-url={`api/v1/board/{boardName}/post`}
                        data-method="post">전송
                </button>
                <button type="button" className="btn">취소</button>
            </div>
        </HomeLayout>
    );
}
