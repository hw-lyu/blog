import React from "@inertiajs/react";
import HomeLayout from "../Layout/HomeLayout";
import {useEffect, useState} from "react";
import axios from "axios";
import TagList from "./TagList";

type Props = {
    post_id: number
}

export default function Detail({post_id}: Props) {
    const [data, setData] = useState([]);
    const [boardTagData, setBoardTagData] = useState([]);

    useEffect(() => {
        axios.get(`/api/v1/board/post/${post_id}`)
            .then((res) => {
                setData(res.data.post);

                return res.data.post;
            })
            .then(res => {
                axios.get(`/api/v1/board/tag/${res.tag_id}`)
                    .then((response) => {
                        setBoardTagData(response.data.tagList);
                    });
            });
    }, []);

    return (
        <HomeLayout children>
            <div className="mockup-browser border bg-base-300 mb-10">
                <div className="mockup-browser-toolbar">
                    <div className="input"><span className="align-sub">{data.subject}</span></div>
                </div>
                <div className="flex justify-center px-4 py-16 bg-base-200">{data.content}</div>
            </div>

            <TagList children name_ko={boardTagData.name_ko}>
                {
                    boardTagData.post?.map((ele: {
                        url: string;
                        subject: string;
                        created_at: string;
                    }, idx: number) => {
                        return (
                            <li key={idx}>
                                <a href={ele.url} className="link">{ele.subject}</a>
                                <span className="ml-2">{new Date(ele.created_at).toLocaleString()}</span>
                            </li>
                        )
                    })
                }
            </TagList>
        </HomeLayout>
    )
}
