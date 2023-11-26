import axios from "axios";
import React from '@inertiajs/react';
import {useState, useEffect} from "react";
import HomeLayout from "./Layout/HomeLayout";
import List from "./Component/List";
import Pagination from "./Component/Pagination";
import {MemberContext} from "./Layout/MemberContext";

type Props = {
    board_name: string
}
const Welcome = ({board_name}) => {
    const [data, setData] = useState([]);
    const [paginationData, setPaginationData] = useState([]);

    useEffect(() => {
        axios.get(`/api/v1${location.pathname === '/' ? '/board/all/post' : location.pathname}${location.search}`)
            .then((res) => {
                setData(res.data.post.data);
                setPaginationData(res.data.post.links);
            })
    }, []);

    return (
        <HomeLayout children>
            <MemberContext.Consumer>
                {(value: { is_admin: boolean; }): Element | string => value.is_admin ?
                    <>
                        <div className="flex justify-end mb-3">
                            <a href={`/board/${board_name === undefined ? 'all' : board_name}/post/create`} className="link">글쓰기</a>
                        </div>
                    </> : ""}
            </MemberContext.Consumer>
            {data.map((ele: any, idx: number) => {
                return (
                    <List key={idx} post_id={ele.id} subject={ele.subject}
                          strip_content={ele.strip_content}
                          created_at={ele.created_at}
                          files={JSON.parse(ele.file_data)}>
                    </List>
                );
            })}
            <Pagination children>
                {paginationData.map((ele: any, idx: number) => {
                    return (
                        <a href={ele.url?.replace('/api/v1', '')} key={idx}
                           className={`join-item btn${ele.active ? ' btn-active' : ''}`}
                           dangerouslySetInnerHTML={{__html: ele.label}}></a>
                    );
                })}
            </Pagination>
        </HomeLayout>
    )
}

export default Welcome
