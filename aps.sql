PGDMP         5            
    w            aps    10.9    10.9                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            �            1259    49278 	   mail_list    TABLE     O   CREATE TABLE public.mail_list (
    mail_id integer NOT NULL,
    mail text
);
    DROP TABLE public.mail_list;
       public         postgres    false                       0    0    TABLE mail_list    ACL     e   REVOKE ALL ON TABLE public.mail_list FROM postgres;
GRANT ALL ON TABLE public.mail_list TO apsadmin;
            public       postgres    false    208            �
           2606    49285    mail_list mail_list_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.mail_list
    ADD CONSTRAINT mail_list_pkey PRIMARY KEY (mail_id);
 B   ALTER TABLE ONLY public.mail_list DROP CONSTRAINT mail_list_pkey;
       public         postgres    false    208           