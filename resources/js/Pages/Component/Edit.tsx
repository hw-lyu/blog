import React from "@inertiajs/react";
import axios from "axios";
import {useEffect, useRef, useState} from "react";
import HomeLayout from "../Layout/HomeLayout";
import Editor from '@toast-ui/editor';
import Auth from "./Auth";

type Props = {
    board_name: string
    post_id: number
}

export default function Edit({board_name, post_id}: Props) {
    const [data, setData] = useState([]);
    const [formData, setFormData] = useState([]);
    const editorRef = useRef(null);
    const subject = useRef('');

    useEffect(() => {
        axios.get(`/api/v1/board/${board_name}/post/${post_id}`)
            .then((res) => {
                setData(res.data.post);
            });
    }, []);

    useEffect(() => {
        if (editorRef.current !== null) {
            const editorOption: any = {
                initialEditType: 'wysiwyg',
                el: editorRef.current,
                height: '500px',
                previewStyle: 'vertical',
            };
            const editor: Editor = new Editor(editorOption);

            editor.getMarkdown();
            editor.setHTML(data.content);

            setFormData({...data, content: editor.getHTML()});
        }

    }, [data]);

    return (
        <HomeLayout children>
            <Auth board_name={board_name} post_id={post_id}
                  formData={formData} children>
                <div className="mockup-browser border bg-base-300 mb-10">
                    <div className="mockup-browser-toolbar">
                        <div className="input">
                            <input type="text" className="w-full bg-transparent align-sub" ref={subject} defaultValue={data.subject || ''}
                                   onChange={e => {
                                       setFormData({...formData, subject: e.target.value})
                                   }}/>
                        </div>
                    </div>
                    <div id="editor" ref={editorRef} className="w-ful lflex justify-center px-4 py-4 bg-base-200"></div>
                </div>
            </Auth>
        </HomeLayout>
    );
}
