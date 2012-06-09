--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

-- CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

--COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: aviso; Type: TABLE; Schema: public; Owner: colegio; Tablespace: 
--

CREATE TABLE aviso (
    idaviso integer NOT NULL,
    data time without time zone DEFAULT now() NOT NULL,
    aviso text NOT NULL
);


ALTER TABLE public.aviso OWNER TO colegio;

--
-- Name: aviso_idaviso_seq; Type: SEQUENCE; Schema: public; Owner: colegio
--

CREATE SEQUENCE aviso_idaviso_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.aviso_idaviso_seq OWNER TO colegio;

--
-- Name: aviso_idaviso_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: colegio
--

ALTER SEQUENCE aviso_idaviso_seq OWNED BY aviso.idaviso;


--
-- Name: contato; Type: TABLE; Schema: public; Owner: colegio; Tablespace: 
--

CREATE TABLE contato (
    idcontato integer NOT NULL,
    remetente character varying(60) NOT NULL,
    email character varying(60) NOT NULL,
    assunto character varying(50) NOT NULL,
    mensagem text NOT NULL
);


ALTER TABLE public.contato OWNER TO colegio;

--
-- Name: contato_idcontato_seq; Type: SEQUENCE; Schema: public; Owner: colegio
--

CREATE SEQUENCE contato_idcontato_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contato_idcontato_seq OWNER TO colegio;

--
-- Name: contato_idcontato_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: colegio
--

ALTER SEQUENCE contato_idcontato_seq OWNED BY contato.idcontato;


--
-- Name: recado; Type: TABLE; Schema: public; Owner: colegio; Tablespace: 
--

CREATE TABLE recado (
    idrecado integer NOT NULL,
    remetente character varying(60) NOT NULL,
    destinatario character varying(60) NOT NULL,
    data time without time zone DEFAULT now() NOT NULL,
    mensagem text NOT NULL
);


ALTER TABLE public.recado OWNER TO colegio;

--
-- Name: recado_idrecado_seq; Type: SEQUENCE; Schema: public; Owner: colegio
--

CREATE SEQUENCE recado_idrecado_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.recado_idrecado_seq OWNER TO colegio;

--
-- Name: recado_idrecado_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: colegio
--

ALTER SEQUENCE recado_idrecado_seq OWNED BY recado.idrecado;


--
-- Name: video; Type: TABLE; Schema: public; Owner: colegio; Tablespace: 
--

CREATE TABLE video (
    idvideo integer NOT NULL,
    titulo character varying(100) NOT NULL,
    url character varying(255) NOT NULL
);


ALTER TABLE public.video OWNER TO colegio;

--
-- Name: video_idvideo_seq; Type: SEQUENCE; Schema: public; Owner: colegio
--

CREATE SEQUENCE video_idvideo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.video_idvideo_seq OWNER TO colegio;

--
-- Name: video_idvideo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: colegio
--

ALTER SEQUENCE video_idvideo_seq OWNED BY video.idvideo;


--
-- Name: idaviso; Type: DEFAULT; Schema: public; Owner: colegio
--

ALTER TABLE ONLY aviso ALTER COLUMN idaviso SET DEFAULT nextval('aviso_idaviso_seq'::regclass);


--
-- Name: idcontato; Type: DEFAULT; Schema: public; Owner: colegio
--

ALTER TABLE ONLY contato ALTER COLUMN idcontato SET DEFAULT nextval('contato_idcontato_seq'::regclass);


--
-- Name: idrecado; Type: DEFAULT; Schema: public; Owner: colegio
--

ALTER TABLE ONLY recado ALTER COLUMN idrecado SET DEFAULT nextval('recado_idrecado_seq'::regclass);


--
-- Name: idvideo; Type: DEFAULT; Schema: public; Owner: colegio
--

ALTER TABLE ONLY video ALTER COLUMN idvideo SET DEFAULT nextval('video_idvideo_seq'::regclass);


--
-- Name: aviso_pkey; Type: CONSTRAINT; Schema: public; Owner: colegio; Tablespace: 
--

ALTER TABLE ONLY aviso
    ADD CONSTRAINT aviso_pkey PRIMARY KEY (idaviso);


--
-- Name: contato_pkey; Type: CONSTRAINT; Schema: public; Owner: colegio; Tablespace: 
--

ALTER TABLE ONLY contato
    ADD CONSTRAINT contato_pkey PRIMARY KEY (idcontato);


--
-- Name: recado_pkey; Type: CONSTRAINT; Schema: public; Owner: colegio; Tablespace: 
--

ALTER TABLE ONLY recado
    ADD CONSTRAINT recado_pkey PRIMARY KEY (idrecado);


--
-- Name: video_pkey; Type: CONSTRAINT; Schema: public; Owner: colegio; Tablespace: 
--

ALTER TABLE ONLY video
    ADD CONSTRAINT video_pkey PRIMARY KEY (idvideo);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

